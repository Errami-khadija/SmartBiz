<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invoice;
use App\Models\Client;
use App\Models\Project;
use App\Models\TimeEntry;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
}
