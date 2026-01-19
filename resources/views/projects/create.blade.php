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

             {{-- Start Date --}}
    <div>
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
