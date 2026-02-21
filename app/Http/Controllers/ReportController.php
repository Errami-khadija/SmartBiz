<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Client;
use App\Models\Project;
use App\Models\TimeEntry;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\StreamedResponse;


class ReportController extends Controller
{
     public function index()
    {
        // Revenue Overview (Last 4 months)
        $months = collect(range(0, 3))->map(function ($i) {
            $date = Carbon::now()->subMonths($i);
            return [
                'month' => $date->format('F'),
                'total' => Invoice::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->sum('amount')
            ];
        })->reverse();

        // Top Clients by Revenue
        $topClients = Invoice::select(
            'clients.name',
            DB::raw('SUM(invoices.amount) as total_revenue')
        )
        ->join('clients', 'invoices.client_id', '=', 'clients.id')
        ->groupBy('clients.id', 'clients.name')
        ->orderByDesc('total_revenue')
        ->limit(4)
        ->get();

$totalRevenue = \App\Models\Invoice::sum('amount');
     
   // Project Status Breakdown
        $projects = Project::withCount([
    'tasks',
    'tasks as completed_tasks_count' => function ($query) {
        $query->where('status', 'completed');
    }
])->get();

$completedProjects = $projects->where('tasks_count', '>', 0)
                               ->where('tasks_count', fn($v, $k) => 
                                   $projects[$k]->tasks_count == $projects[$k]->completed_tasks_count
                               )->count();

$activeProjects = $projects->count() - $completedProjects;
$onHoldProjects = 0;
        // Payment Status
        $paid = Invoice::where('status', 'paid')->sum('amount');
        $pending = Invoice::where('status', 'pending')->sum('amount');
        $overdue = Invoice::where('status', 'overdue')->sum('amount');

        // Time Breakdown (in hours)
       $totalMinutes = TimeEntry::sum('minutes');
$totalHours = round($totalMinutes / 60, 1);

$billableHours = $totalHours;
$nonBillableHours = 0;
        return view('reports.index', compact(
            'months',
            'topClients',
            'totalRevenue',
            'activeProjects',
            'completedProjects',
            'onHoldProjects',
            'paid',
            'pending',
            'overdue',
            'billableHours',
            'nonBillableHours'
        ));
    }

    public function exportPdf()
{
    // Revenue per month
   $months = Invoice::selectRaw("
        DATE_FORMAT(created_at, '%Y-%m') as month_key,
        DATE_FORMAT(created_at, '%M %Y') as month,
        SUM(amount) as total
    ")
    ->groupBy('month_key', 'month')
    ->orderBy('month_key')
    ->get();

    // Total revenue
    $totalRevenue = Invoice::sum('amount');

    // Top clients
    $topClients = Invoice::select(
            'clients.name',
            DB::raw('SUM(invoices.amount) as total_revenue')
        )
        ->join('clients', 'invoices.client_id', '=', 'clients.id')
        ->groupBy('clients.id', 'clients.name')
        ->orderByDesc('total_revenue')
        ->limit(5)
        ->get();

    // Project status
   $projects = Project::withCount([
    'tasks',
    'tasks as completed_tasks_count' => function ($query) {
        $query->where('status', 'completed');
    }
])->get();

$activeProjects = 0;
$completedProjects = 0;
$onHoldProjects = 0;

foreach ($projects as $project) {

    if ($project->tasks_count == 0) {
        $onHoldProjects++;
    } elseif ($project->completed_tasks_count == $project->tasks_count) {
        $completedProjects++;
    } else {
        $activeProjects++;
    }
}

    // Payment status
    $paid = Invoice::where('status', 'Paid')->sum('amount');
    $pending = Invoice::where('status', 'Pending')->sum('amount');
    $overdue = Invoice::where('status', 'Overdue')->sum('amount');

    // Time 
    $totalMinutes = TimeEntry::sum('minutes');
$totalHours = round($totalMinutes / 60, 1);

$billableHours = $totalHours;
$nonBillableHours = 0;

    $pdf = Pdf::loadView('reports.full-report-pdf', compact(
        'months',
        'topClients',
        'totalRevenue',
        'activeProjects',
        'completedProjects',
        'onHoldProjects',
        'paid',
        'pending',
        'overdue',
        'billableHours',
        'nonBillableHours'
    ));

    return $pdf->download('business-report.pdf');
}


public function exportCsv()
{
    return response()->streamDownload(function () {

        $handle = fopen('php://output', 'w');

        /*
        |--------------------------------------------------------------------------
        | Revenue Overview
        |--------------------------------------------------------------------------
        */

        fputcsv($handle, ['REVENUE OVERVIEW']);
        fputcsv($handle, ['Month', 'Total']);

        $months = Invoice::selectRaw("
                DATE_FORMAT(created_at, '%Y-%m') as month_key,
                DATE_FORMAT(created_at, '%M %Y') as month,
                SUM(amount) as total
            ")
            ->groupBy('month_key', 'month')
            ->orderBy('month_key')
            ->get();

        foreach ($months as $month) {
            fputcsv($handle, [$month->month, $month->total]);
        }

        fputcsv($handle, []); // empty row


        /*
        |--------------------------------------------------------------------------
        | Top Clients
        |--------------------------------------------------------------------------
        */

        fputcsv($handle, ['TOP CLIENTS']);
        fputcsv($handle, ['Client Name', 'Total Revenue']);

        $topClients = Invoice::select(
                'clients.name',
                DB::raw('SUM(invoices.amount) as total_revenue')
            )
            ->join('clients', 'invoices.client_id', '=', 'clients.id')
            ->groupBy('clients.id', 'clients.name')
            ->orderByDesc('total_revenue')
            ->get();

        foreach ($topClients as $client) {
            fputcsv($handle, [$client->name, $client->total_revenue]);
        }

        fputcsv($handle, []);


        /*
        |--------------------------------------------------------------------------
        | Project Status (Dynamic from Tasks)
        |--------------------------------------------------------------------------
        */

        $projects = Project::withCount([
            'tasks',
            'tasks as completed_tasks_count' => function ($query) {
                $query->where('status', 'completed');
            }
        ])->get();

        $active = 0;
        $completed = 0;
        $onHold = 0;

        foreach ($projects as $project) {

            if ($project->tasks_count == 0) {
                $onHold++;
            } elseif ($project->completed_tasks_count == $project->tasks_count) {
                $completed++;
            } else {
                $active++;
            }
        }

        fputcsv($handle, ['PROJECT STATUS']);
        fputcsv($handle, ['Active', 'Completed', 'On Hold']);
        fputcsv($handle, [$active, $completed, $onHold]);

        fputcsv($handle, []);


        /*
        |--------------------------------------------------------------------------
        | Payment Status
        |--------------------------------------------------------------------------
        */

        $paid = Invoice::where('status', 'Paid')->sum('amount');
        $pending = Invoice::where('status', 'Pending')->sum('amount');
        $overdue = Invoice::where('status', 'Overdue')->sum('amount');

        fputcsv($handle, ['PAYMENT STATUS']);
        fputcsv($handle, ['Paid', 'Pending', 'Overdue']);
        fputcsv($handle, [$paid, $pending, $overdue]);

        fputcsv($handle, []);



        fclose($handle);

    }, 'business-report.csv');
}
}
