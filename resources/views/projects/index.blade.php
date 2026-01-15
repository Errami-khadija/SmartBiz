<x-app-layout>

{{-- Page Header --}}

<div class="mb-6 flex items-center justify-between">
    <x-page-header
        title="Projects"
        subtitle="Overview of all projects and their statuses"
    />

    <button onclick="toggleProjectForm()"
        class="flex items-center gap-2 px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-medium transition-colors">
        ➕ New Project
    </button>
</div>

{{-- Add Project Form --}}
<div id="project-form-container"
    class="hidden mb-6 bg-white rounded-2xl border border-slate-100 p-6">

    <h2 class="heading-font text-xl font-bold text-slate-800 mb-4">
        Create New Project
    </h2>

    <form action="{{ route('projects.store') }}" method="POST" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Project Name
                </label>
                <input type="text" name="name" required
                    class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-emerald-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Client
                </label>
                <select name="client_id" required
                    class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-emerald-500">
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Budget
                </label>
                <input type="number" step="0.01" name="budget"
                    class="w-full px-4 py-2 border border-slate-200 rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Status
                </label>
                <select name="status"
                    class="w-full px-4 py-2 border border-slate-200 rounded-lg">
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

        </div>

        <div class="flex gap-3">
            <button type="submit"
                class="px-6 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600">
                Create Project
            </button>

            <button type="button" onclick="toggleProjectForm()"
                class="px-6 py-2 bg-slate-100 text-slate-700 rounded-lg">
                Cancel
            </button>
        </div>
    </form>
</div>

{{-- Projects List --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

@forelse ($projects as $project)
    
    <div class="bg-white rounded-2xl p-6 border border-slate-100">

        <div class="flex items-start gap-4 mb-4">
            <div class="w-14 h-14 rounded-xl bg-emerald-500 flex items-center justify-center text-white font-bold text-xl">
                {{ strtoupper(substr($project->name, 0, 1)) }}
            </div>

            <div class="flex-1">
                <h3 class="heading-font text-lg font-bold text-slate-800">
                    {{ $project->name }}
                </h3>
                <p class="text-sm text-slate-500">
                    {{ $project->client->name }}
                </p>

                <span class="inline-block mt-2 text-xs font-medium px-2 py-1 rounded-full
                    {{ $project->status === 'completed' ? 'bg-green-100 text-green-600' : 'bg-blue-100 text-blue-600' }}">
                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                </span>
            </div>
        </div>

        <div class="flex items-center justify-between pt-3 border-t border-slate-100">
            <span class="text-slate-600 text-sm">Budget</span>
            <span class="heading-font text-xl font-bold text-slate-800">
                ${{ number_format($project->budget, 2) }}
            </span>
        </div>

        <div class="flex gap-2 mt-4">
            <a href="{{ route('projects.show', $project) }}"
                class="flex-1 px-4 py-2 bg-emerald-50 text-emerald-600 rounded-lg text-center">
                View Details
            </a>

            <form action="{{ route('projects.destroy', $project) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="px-4 py-2 bg-rose-50 text-rose-600 rounded-lg">
                    🗑
                </button>
            </form>
        </div>
        @empty
        <div class="text-center py-10 col-span-2 text-slate-500">
            No projects found. Click "New Project" to add your first project.
        </div>
    @endforelse

</div>

{{-- Pagination --}}
<div class="mt-6">
    {{ $projects->links() }}
</div>
</x-app-layout>