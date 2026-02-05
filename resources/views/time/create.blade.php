<x-app-layout>

<div class="max-w-3xl mx-auto bg-white rounded-2xl border border-slate-100 p-6">
    <h2 class="heading-font text-xl font-bold text-slate-800 mb-4">Add Time Entry</h2>

    <form method="POST" action="{{ route('time-entries.store') }}" class="space-y-4">
        @csrf

        <div class="grid md:grid-cols-3 gap-4">
            <input name="project" placeholder="Project" class="input">
            <input name="task" placeholder="Task" class="input">
            <input name="duration" placeholder="2h 30m" class="input">
        </div>

        <div class="flex gap-3">
            <button class="px-6 py-2 bg-emerald-500 text-white rounded-lg">
                Save
            </button>
            <a href="{{ route('time-entries.index') }}"
               class="px-6 py-2 bg-slate-100 rounded-lg">
                Cancel
            </a>
        </div>
    </form>
</div>

</x-app-layout>
