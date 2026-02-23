<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\TimeEntry;
use App\Models\Task;
use Carbon\Carbon;


class DashboardController extends Controller
{
   public function index()
    {
        // Revenue
        $totalRevenue = Invoice::where('status', 'paid')->sum('amount');
        $lastMonthRevenue = Invoice::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('amount');

        // Projects
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
        $recentProjects = Project::latest()->take(3)->get();

        // Clients
        $totalClients = Client::count();

        // Hours This Month
        $hoursThisMonth = TimeEntry::whereMonth('created_at', now()->month)
    ->whereYear('created_at', now()->year)
    ->sum('minutes') / 60;

    // Upcoming Tasks (next 5 not completed)
$upcomingTasks = Task::where('status', 'done') 
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

        // Recent Invoices
        $recentInvoices = Invoice::latest()->take(2)->get();

        return view('dashboard.index', compact(
            'totalRevenue',
            'lastMonthRevenue',
            'activeProjects',
            'recentProjects',
            'totalClients',
            'upcomingTasks',
            'hoursThisMonth',
            'recentInvoices'
        ));
    }
}
