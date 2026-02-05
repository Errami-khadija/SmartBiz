<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeEntry;

class TimeEntryController extends Controller
{
    public function index()
    {
        $entries = TimeEntry::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('time.index', compact('entries'));
    }

    public function create()
    {
        return view('time.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'project' => 'required',
            'task' => 'required',
            'duration' => 'required',
        ]);

        TimeEntry::create([
            'user_id' => auth()->id(),
            'project' => $request->project,
            'task' => $request->task,
            'duration' => $request->duration,
            'date' => now(),
            'status' => 'Completed',
        ]);

        return redirect()->route('time-entries.index');
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
