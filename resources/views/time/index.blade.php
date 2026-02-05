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

{{-- Entries --}}
<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100">
        <h2 class="heading-font text-lg font-bold text-slate-800">Recent Time Entries</h2>
    </div>

    @foreach($entries as $entry)
        <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50">
            <div class="flex-1">
                <p class="font-medium text-slate-800">{{ $entry->task }}</p>
                <p class="text-sm text-slate-500">{{ $entry->project }}</p>
            </div>

            <div class="flex-1 text-center text-sm text-slate-600">
                {{ $entry->date->format('M d, Y') }}
            </div>

            <div class="flex-1 text-center font-bold">
                {{ $entry->duration }}
            </div>

            <div class="flex-1 text-center">
                <span class="text-xs font-medium text-emerald-600 bg-emerald-100 px-3 py-1 rounded-full">
                    {{ $entry->status }}
                </span>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('time-entries.show', $entry) }}"
                   class="px-3 py-2 bg-slate-100 rounded-lg">View</a>

                <form method="POST" action="{{ route('time-entries.destroy', $entry) }}">
                    @csrf @method('DELETE')
                    <button class="px-3 py-2 bg-rose-50 text-rose-600 rounded-lg">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</div>

</x-app-layout>
