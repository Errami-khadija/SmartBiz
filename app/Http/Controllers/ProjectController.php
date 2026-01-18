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
        'status' => 'required',
         'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
    ]);

    Project::create($request->all());

    return redirect()->route('projects.index')
        ->with('success', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $clients = Client::all();
    return view('admin.projects.edit', compact('project', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $project->update($request->all());

    return redirect()->route('projects.index')
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
