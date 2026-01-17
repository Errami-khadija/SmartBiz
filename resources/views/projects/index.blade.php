<x-app-layout>

{{-- Page Header --}}
<div class="mb-6 flex items-center justify-between">
    <x-page-header
        title="Projects"
        subtitle="Overview of all projects and their statuses"
    />

    <a href="{{ route('projects.create') }}"
       class="flex items-center gap-2 px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-medium transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 4v16m8-8H4"/>
        </svg>
        New Project
    </a>
</div>

{{-- Projects Grid --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    @forelse ($projects as $project)

        <div class="bg-white rounded-2xl p-6 border border-slate-100">

            {{-- Header --}}
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
                        {{ $project->status === 'completed'
                            ? 'bg-green-100 text-green-600'
                            : 'bg-blue-100 text-blue-600' }}">
                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                    </span>
                </div>
            </div>

            {{-- Budget --}}
            <div class="flex items-center justify-between pt-3 border-t border-slate-100">
                <span class="text-slate-600 text-sm">Budget</span>
                <span class="heading-font text-xl font-bold text-slate-800">
                    ${{ number_format($project->budget, 2) }}
                </span>
            </div>

            {{-- Actions --}}
            <div class="flex gap-2 mt-4">
                <a href="{{ route('projects.show', $project) }}"
                   class="flex-1 px-4 py-2 bg-emerald-50 text-emerald-600 rounded-lg text-center">
                    View Details
                </a>

                <form action="{{ route('projects.destroy', $project) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="px-4 py-2 bg-rose-50 rounded-lg">
                        <button class="text-rose-600 hover:text-rose-700">
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                         </svg>
                        </button>
                    </div>
                </form>
            </div>

        </div>

    @empty
        <div class="col-span-full text-center py-10 text-slate-500">
            No projects found. Click <strong>New Project</strong> to add your first project.
        </div>
    @endforelse

</div>

{{-- Pagination --}}
<div class="mt-6">
    {{ $projects->links() }}
</div>

</x-app-layout>
