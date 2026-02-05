<x-app-layout>

<div class="max-w-xl mx-auto bg-white rounded-2xl p-8 border">
    <div class="flex items-center gap-4 mb-6">
        <div class="w-14 h-14 rounded-xl bg-emerald-100 flex items-center justify-center">
            ⏱️
        </div>
        <div>
            <h2 class="heading-font text-2xl font-bold">{{ $timeEntry->task }}</h2>
            <p class="text-slate-500">{{ $timeEntry->project }}</p>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-slate-50 p-4 rounded-xl">
            <p class="text-sm">Duration</p>
            <p class="font-bold text-xl">{{ $timeEntry->duration }}</p>
        </div>
        <div class="bg-slate-50 p-4 rounded-xl">
            <p class="text-sm">Date</p>
            <p>{{ $timeEntry->date->format('M d, Y') }}</p>
        </div>
        <div class="bg-slate-50 p-4 rounded-xl">
            <p class="text-sm">Status</p>
            <span class="text-emerald-600">{{ $timeEntry->status }}</span>
        </div>
    </div>

    <a href="{{ route('time-entries.index') }}"
       class="block text-center bg-slate-100 rounded-xl py-3">
        Back
    </a>
</div>

</x-app-layout>
