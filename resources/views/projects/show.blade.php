<x-app-layout>
    
    <div class="max-w-6xl mx-auto py-8 px-4">

        {{-- Page Header --}}
        <div class="flex items-start justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">
                    {{ $project->name }}
                </h1>
                <p class="text-slate-500 mt-1">
                    {{ $project->client->name ?? 'No client assigned' }}
                </p>
            </div>

            <div class="flex gap-3">
                <button
                    onclick="openEditProjectModal({{ $project->id }})"
                   class="px-5 py-2.5 bg-emerald-500 text-white rounded-xl font-medium hover:bg-emerald-600">
                    Edit
                </button>

                <a href="{{ route('projects.index') }}"
                   class="px-5 py-2.5 bg-slate-100 text-slate-700 rounded-xl font-medium hover:bg-slate-200">
                    Back
                </a>
            </div>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-white rounded-xl shadow p-6">
                <p class="text-sm text-slate-500">Budget</p>
                <p class="text-2xl font-bold text-slate-800 mt-2">
                    {{ $project->budget ?? '—' }} $
                </p>
            </div>

           <div class="bg-white rounded-xl shadow p-6">
    <p class="text-sm text-slate-500">Status</p>

    @php
        $status = $project->status;
    @endphp

   <span class="inline-block mt-2 text-xs font-medium px-2 py-1 rounded-full {{ $project->status_color }}">
                      {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                  </span>
</div>


<div class="bg-white rounded-xl shadow p-6">
    <p class="text-sm text-slate-500">Progress</p>
    <p class="text-2xl font-bold text-slate-800 mt-2">
        {{ $project->progress }}%
    </p>
</div>


        </div>

        {{-- Progress Bar --}}
        <div class="bg-white rounded-xl shadow p-6 mb-8">
            <div class="flex justify-between mb-3">
                <span class="font-medium text-slate-700">Project Progress</span>
                <span  id="projectProgressText" class="font-bold text-slate-800">
                    {{ $project->progress ?? 0 }}%
                </span>
            </div>

            <div class="w-full h-3 bg-slate-200 rounded-full overflow-hidden">
                <div class="h-full bg-emerald-500 rounded-full"
                      id="projectProgressBar"
                     style="width: {{ $project->progress ?? 0 }}%">
                </div>
            </div>
        </div>

        {{-- Tasks --}}
<div class="bg-white rounded-xl shadow p-6 mt-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-bold text-slate-800">
            Tasks
        </h2>

        <button
             onclick="addTaskRowToShowPage()"
            class="px-4 py-2 bg-emerald-500 text-white rounded-xl text-sm hover:bg-emerald-600">
            + Add Task
        </button>
    </div>
   <div id="tasks-container" class="space-y-3 mb-4" data-project-id="{{ $project->id }}"></div>


    @if($project->tasks->count())
        <div class="space-y-4">
            @foreach($project->tasks as $task)
                <div class="flex justify-between items-center p-4 border rounded-xl">
                    <div>
                        <p
                          id="task-title-{{ $task->id }}"
                         class="font-medium text-slate-800">
                            {{ $task->title }}
                        </p>
                        
                    </div>

                   <div class="flex items-center gap-3">
                      <input
                          type="checkbox"
                          class="w-5 h-5 text-emerald-500 border-slate-300 rounded focus:ring-emerald-500"
                          {{ $task->status === 'done' ? 'checked' : '' }}
                          onchange="toggleTaskStatus({{ $task->id }}, this.checked)"
                      >
                  </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-slate-500 text-sm">
            No tasks added yet.
        </p>
    @endif
</div>



</div>


        {{-- Description --}}
        <div class="bg-white rounded-xl shadow p-6 mb-8">
            <h2 class="text-lg font-bold text-slate-800 mb-4">
                Project Description
            </h2>
            <p class="text-slate-700">
                {{ $project->description ?? 'No description provided.' }}
            </p>
        </div>

        {{-- Details --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-bold text-slate-800 mb-4">
                Project Details
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex justify-between">
                    <span class="text-slate-500">Client</span>
                    <span class="font-medium text-slate-800">
                        {{ $project->client->name ?? '—' }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Project ID</span>
                    <span class="font-medium text-slate-800">
                        #PRJ-{{ str_pad($project->id, 4, '0', STR_PAD_LEFT) }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Start Date</span>
                    <span class="font-medium text-slate-800">
                        {{ $project->start_date ?? '—' }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Deadline</span>
                    <span class="font-medium text-slate-800">
                        {{ $project->end_date ?? '—' }}
                    </span>
                </div>
            </div>
        </div>

    </div>

    @include('projects._edit-modal', ['project' => $project])
</x-app-layout>
