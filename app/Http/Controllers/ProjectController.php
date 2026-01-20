<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('client')->latest()->paginate(10);
         $clients = Client::latest()->get();

    return view('projects.index', compact('projects', 'clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
    return view('projects.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'client_id' => 'required|exists:clients,id',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'budget' => 'nullable|numeric',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'tasks.*.title' => 'nullable|string|max:255',
    ]);

    // 1️⃣ Create project AND keep reference
    $project = Project::create($request->only([
        'client_id',
        'name',
        'description',
        'budget',
        'start_date',
        'end_date',
    ]));

    // 2️⃣ Create tasks
    if ($request->filled('tasks')) {
        foreach ($request->tasks as $task) {
            if (!empty($task['title'])) {
                $project->tasks()->create([
                    'title' => $task['title'],
                    // status defaults to "todo"
                ]);
            }
        }
    }

    return redirect()
        ->route('projects.index')
        ->with('success', 'Project created successfully');
}

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {  
         $project->load('client', 'tasks');
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
{
    $project = Project::findOrFail($id);

   $validated = $request->validate([
    'name' => 'required|string|max:255',
    'description' => 'nullable|string',
    'start_date' => 'nullable|date',
    'end_date' => 'nullable|date|after_or_equal:start_date',
]);


    $project->update($validated);

    return redirect()
        ->route('projects.show', $project)
        ->with('success', 'Project updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
    {
         $project = Project::findOrFail($id);
         $project->delete();

    return redirect()->route('projects.index')
        ->with('success', 'Project deleted successfully');
    }
}
