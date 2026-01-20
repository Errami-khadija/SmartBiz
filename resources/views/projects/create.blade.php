<x-app-layout>

{{-- Add Project Form --}}
<div id="project-form-container"
    class=" mb-6 bg-white rounded-2xl border border-slate-100 p-6">

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

             {{-- Start Date --}}
  
        <label class="block text-sm font-medium text-slate-700 mb-2">
            Start Date
        </label>
        <input type="date" name="start_date"
               class="w-full px-4 py-2 border border-slate-200 rounded-lg">
    </div>


    {{-- End Date --}}
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">
            End Date
        </label>
        <input type="date" name="end_date"
               class="w-full px-4 py-2 border border-slate-200 rounded-lg">
    </div>

        </div>


        {{-- Description --}}
<div>
    <label class="block text-sm font-medium text-slate-700 mb-2">
        Description
    </label>
    <textarea
        name="description"
        rows="4"
        placeholder="Describe the project details..."
        class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-emerald-500"
    ></textarea>
</div>

    {{-- Tasks section --}}
<div class="mt-6">
    <div class="flex justify-between items-center mb-3">
        <h3 class="text-lg font-semibold text-slate-800">
            Tasks
        </h3>

        <button type="button"
            onclick="addTaskRow()"
            class="text-sm text-green-500 px-4 py-2 bg-slate-100 rounded-lg hover:bg-slate-200">
            + Add Task
        </button>
    </div>

    <div id="tasks-container" class="space-y-3">

        {{-- Task row --}}
        <div class="flex items-center gap-3 task-row">
            <input
                type="text"
                name="tasks[0][title]"
                placeholder="Task title"
                class="flex-1 px-4 py-2 border border-slate-200 rounded-lg"
            />

            {{-- Delete --}}
            <button type="button"
                onclick="removeTaskRow(this)"
                class="text-rose-500 hover:text-rose-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                  </svg>
            </button>
        </div>

    </div>
</div>

        {{-- Form Actions --}}
 
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


</x-app-layout>

