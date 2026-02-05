<x-app-layout>
<div class="max-w-xl mx-auto bg-white rounded-2xl p-8 border border-slate-100">
    <div class="flex justify-between mb-6">
        <div>
            <h2 class="heading-font text-2xl font-bold">{{ $expense->item }}</h2>
            <p class="text-slate-500">{{ $expense->category }}</p>
        </div>

        <a href="{{ route('expenses.index') }}" class="text-slate-400">✕</a>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="bg-slate-50 p-4 rounded-xl">
            <p class="text-sm text-slate-600">Amount</p>
            <p class="text-xl font-bold">${{ number_format($expense->amount, 2) }}</p>
        </div>

        <div class="bg-slate-50 p-4 rounded-xl">
            <p class="text-sm text-slate-600">Date</p>
            <p class="font-medium">{{ $expense->date->format('M d, Y') }}</p>
        </div>
    </div>

    <div class="border-t pt-4">
        <h3 class="font-bold mb-2">Notes</h3>
        <p class="text-slate-600">
            {{ $expense->notes ?? 'No notes provided.' }}
        </p>
    </div>
</div>
</x-app-layout>
