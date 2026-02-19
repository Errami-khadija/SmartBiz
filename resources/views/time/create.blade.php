<x-app-layout>

<div class="max-w-3xl mx-auto bg-white rounded-2xl border border-slate-100 p-6">
    <h2 class="heading-font text-xl font-bold text-slate-800 mb-6">
        Add Time Entry
    </h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('time-entries.store') }}" class="space-y-6">
        @csrf

        <div class="grid md:grid-cols-2 gap-4">

            {{-- Project Select --}}
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1">
                    Project
                </label>
                <select name="project_id" id="project-select" class="input w-full" required>
                    <option value="">Select Project</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Task Select --}}
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1">
                    Task
                </label>
                <select name="task_id" id="task-select" class="input w-full" required>
                    <option value="">Select Task</option>
                </select>
            </div>

        </div>

        {{-- Duration Input --}}
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1">
                Duration (e.g., 2h 30m)
            </label>
            <input type="text" name="duration" class="input w-full" placeholder="2h 30m" required>
        </div>

        {{-- Submit Buttons --}}
        <div class="flex gap-3 pt-4">
            <button type="submit"
                    class="px-6 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg transition">
                Start Tracking
            </button>

            <a href="{{ route('time-entries.index') }}"
               class="px-6 py-2 bg-slate-100 hover:bg-slate-200 rounded-lg transition">
                Cancel
            </a>
        </div>
    </form>
</div>

{{-- Dynamic Task Loader --}}
<script>
document.getElementById('project-select').addEventListener('change', function () {
    const projectId = this.value;
    const taskSelect = document.getElementById('task-select');

    taskSelect.innerHTML = '<option value="">Loading...</option>';
    taskSelect.disabled = true;

    if (!projectId) {
        taskSelect.innerHTML = '<option value="">Select Task</option>';
        taskSelect.disabled = false;
        return;
    }

    fetch(`/projects/${projectId}/tasks`)
        .then(res => res.json())
        .then(tasks => {
            let options = '<option value="">Select Task</option>';
            tasks.forEach(task => {
                options += `<option value="${task.id}">${task.title}</option>`;
            });
            taskSelect.innerHTML = options;
            taskSelect.disabled = false;
        })
        .catch(err => {
            console.error(err);
            taskSelect.innerHTML = '<option value="">Error loading tasks</option>';
            taskSelect.disabled = false;
        });
});
</script>

</x-app-layout>
