<x-app-layout>

{{-- Header --}}
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="heading-font text-3xl font-bold text-slate-800">Time Tracking</h1>
        <p class="text-slate-500 mt-1">Track time spent on projects</p>
    </div>
    <a href="{{ route('time-entries.create') }}"
       class="flex items-center gap-2 px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-medium">
        + Add Time Entry
    </a>
</div>

{{-- Summary Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    {{-- Today --}}
    <div class="bg-blue-50 p-4 rounded-xl flex items-center gap-3">
        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center text-xl">
            ⏰
        </div>
        <div>
            <p class="text-sm text-slate-500">Today</p>
            <p class="font-bold text-lg">{{ $today }}</p>
        </div>
    </div>

    {{-- This Week --}}
    <div class="bg-green-50 p-4 rounded-xl flex items-center gap-3">
        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-xl">
            📅
        </div>
        <div>
            <p class="text-sm text-slate-500">This Week</p>
            <p class="font-bold text-lg">{{ $thisWeek }}</p>
        </div>
    </div>

    {{-- This Month --}}
    <div class="bg-yellow-50 p-4 rounded-xl flex items-center gap-3">
        <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-xl flex items-center justify-center text-xl">
            🗓️
        </div>
        <div>
            <p class="text-sm text-slate-500">This Month</p>
            <p class="font-bold text-lg">{{ $thisMonth }}</p>
        </div>
    </div>

    {{-- This Year --}}
    <div class="bg-red-50 p-4 rounded-xl flex items-center gap-3">
        <div class="w-12 h-12 bg-red-100 text-red-600 rounded-xl flex items-center justify-center text-xl">
            📊
        </div>
        <div>
            <p class="text-sm text-slate-500">This Year</p>
            <p class="font-bold text-lg">{{ $thisYear }} </p>
        </div>
    </div>
</div>

{{-- Entries --}}
<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100">
        <h2 class="heading-font text-lg font-bold text-slate-800">Recent Time Entries</h2>
    </div>

    @forelse($entries as $entry)
        <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50">
            {{-- Project & Task --}}
            <div class="flex-1">
                <p class="font-medium text-slate-800">{{ $entry->task->title ?? 'N/A' }}</p>
                <p class="text-sm text-slate-500">{{ $entry->project->name ?? 'N/A' }}</p>
            </div>

            {{-- Duration --}}
            <div class="flex-1 text-center font-bold">
                @php
                    $hours = intdiv($entry->minutes, 60);
                    $minutes = $entry->minutes % 60;
                @endphp
                {{ $hours > 0 ? $hours.'h ' : '' }}{{ $minutes }}m
            </div>

            {{-- Date --}}
            <div class="flex-1 text-center text-sm text-slate-500">
                {{ $entry->created_at->format('Y-m-d') }}
            </div>

            {{-- Actions --}}
            <div class="flex gap-2">
                <a href="{{ route('time-entries.show', $entry) }}"
                   class="px-3 py-2 bg-slate-100 rounded-lg">View</a>

                <form method="POST" action="{{ route('time-entries.destroy', $entry) }}"  class="delete-entry-form">
                    @csrf @method('DELETE')
                     <button type="button" class="px-3 py-2 bg-rose-50 text-rose-600 rounded-lg delete-btn">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="px-6 py-4 text-slate-500">
            No time entries yet.
        </div>
    @endforelse
</div>
 
<script>
document.querySelectorAll('.delete-entry-form').forEach(form => {
    form.querySelector('.delete-btn').addEventListener('click', function(e) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This will permanently delete the time entry!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); 
            }
        });
    });
});
</script>

</x-app-layout>
