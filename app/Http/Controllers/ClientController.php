<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::where('user_id', auth()->id())
        // ->withCount([
        //     'projects as active_projects_count' => function ($q) {
        //         $q->where('status', 'in_progress');
        //     }
        // ])
        ->get();

    return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email',
    ]);

    Client::create([
        'user_id' => auth()->id(),
        'name' => $request->name,
        'email' => $request->email,
        'status' => 'active',
    ]);

    return redirect()->route('clients.index')
        ->with('success', 'Client created successfully');

    }

    /**
     * Display the specified resource.
     */
   public function show(Client $client)
{
    abort_if($client->user_id !== auth()->id(), 403);

    $client->load([
        'projects' => function ($q) {
            $q->latest()->take(5);
        }
    ]);

    $activeProjectsCount = $client->projects()
        ->where('status', 'in_progress')
        ->count();

    $totalValue = $client->projects()->sum('budget');

    return view('clients.show', compact(
        'client',
        'activeProjectsCount',
        'totalValue'
    ));
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
  public function update(Request $request, Client $client)
{
    $this->authorizeClient($client);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email',
        'status' => 'required|in:active,inactive',
    ]);

    $client->update($request->only('name', 'email', 'status'));

    return redirect()->route('clients.index')
        ->with('success', 'Client updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
public function destroy(Client $client)
{
    $this->authorizeClient($client);
    $client->delete();

    return back()->with('success', 'Client deleted');
}

    /**
     * Authorize that the client belongs to the authenticated user.
     */
    protected function authorizeClient(Client $client)
    {
        if ($client->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
