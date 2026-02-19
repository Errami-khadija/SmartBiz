<x-app-layout>

<div class="max-w-xl mx-auto bg-white rounded-2xl p-8 border">

    {{-- Header --}}
    <div class="flex items-center gap-4 mb-6">
        <div class="w-14 h-14 rounded-xl bg-emerald-100 flex items-center justify-center text-2xl">
            ⏱️
        </div>
        <div>
            <h2 class="heading-font text-2xl font-bold">
                {{ $timeEntry->task->title ?? 'N/A' }}
            </h2>
            <p class="text-slate-500">
                {{ $timeEntry->project->name ?? 'N/A' }}
            </p>
        </div>
    </div>

    {{-- Total Time Spent Summary --}}
    <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 mb-6 text-center">
        @php
            // Calculate total minutes for this project
            $totalMinutes = $timeEntry->project->timeEntries()->sum('minutes');
            $totalHours = intdiv($totalMinutes, 60);
            $remainingMinutes = $totalMinutes % 60;
        @endphp
        <p class="text-sm text-slate-500">Total Time Spent on Project</p>
        <p class="font-bold text-xl text-emerald-700">
            {{ $totalHours > 0 ? $totalHours.'h ' : '' }}{{ $remainingMinutes }}m
        </p>
    </div>

    {{-- Stats for this entry --}}
    <div class="grid grid-cols-2 gap-4 mb-6">
        {{-- Duration --}}
        <div class="bg-slate-50 p-4 rounded-xl text-center">
            <p class="text-sm">Duration</p>
            <p class="font-bold text-xl">
                @php
                    $hours = intdiv($timeEntry->minutes, 60);
                    $minutes = $timeEntry->minutes % 60;
                @endphp
                {{ $hours > 0 ? $hours.'h ' : '' }}{{ $minutes }}m
            </p>
        </div>

        {{-- Date --}}
        <div class="bg-slate-50 p-4 rounded-xl text-center">
            <p class="text-sm">Date</p>
            <p>{{ $timeEntry->created_at->format('M d, Y') }}</p>
        </div>


        
    </div>

    {{-- Back button --}}
    <a href="{{ route('time-entries.index') }}"
       class="block text-center bg-slate-100 rounded-xl py-3 hover:bg-slate-200 transition">
        Back
    </a>
</div>

</x-app-layout>
