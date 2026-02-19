<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeEntry;
use Carbon\Carbon;

class TimeEntryController extends Controller
{
    public function index()
    {
        $entries = TimeEntry::where('user_id', auth()->id())
            ->latest()
            ->get();
        
         // Helper function to convert minutes to Hh Mm format
    $formatHours = function ($minutes) {
        $h = floor($minutes / 60);
        $m = $minutes % 60;
        return $h . 'h ' . $m . 'm';
    };

    $todayMinutes = TimeEntry::where('user_id', auth()->id())
        ->whereDate('created_at', Carbon::today())
        ->sum('minutes');

    $weekMinutes = TimeEntry::where('user_id', auth()->id())
        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->sum('minutes');

    $monthMinutes = TimeEntry::where('user_id', auth()->id())
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('minutes');

    $yearMinutes = TimeEntry::where('user_id', auth()->id())
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('minutes');

    return view('time.index', [
        'entries' => $entries,
        'today' => $formatHours($todayMinutes),
        'thisWeek' => $formatHours($weekMinutes),
        'thisMonth' => $formatHours($monthMinutes),
        'thisYear' => $formatHours($yearMinutes),
    ]);
    }

   public function create()
{
    $projects = auth()->user()->projects;

    return view('time.create', compact('projects'));
}


   public function store(Request $request)
{
   
  $request->validate([
    'project_id' => 'required|exists:projects,id',
    'task_id' => 'required|exists:tasks,id',
    'duration' => 'required',
]);

// Convert duration to minutes
preg_match_all('/(\d+)([hm])/i', $request->duration, $matches, PREG_SET_ORDER);
$minutes = 0;
foreach ($matches as $match) {
    $value = (int) $match[1];
    if (strtolower($match[2]) === 'h') $minutes += $value * 60;
    if (strtolower($match[2]) === 'm') $minutes += $value;
}

TimeEntry::create([
    'user_id' => auth()->id(),
    'project_id' => $request->project_id,
    'task_id' => $request->task_id,
    'minutes' => $minutes,
]);

    return redirect()->route('time-entries.index')
                     ->with('success', 'Time entry added successfully!');
}

    public function show(TimeEntry $timeEntry)
    {
        return view('time.show', compact('timeEntry'));
    }

    public function destroy(TimeEntry $timeEntry)
    {
        $timeEntry->delete();
        return back();
    }
}
