<x-app-layout>
<div class="max-w-2xl mx-auto bg-white rounded-2xl p-8 border border-slate-100">
    <h1 class="heading-font text-2xl font-bold mb-6">Add Expense</h1>

    <form method="POST" action="{{ route('expenses.store') }}" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Category</label>
            <select name="category" class="input w-full">
                <option>Software</option>
                <option>Office</option>
                <option>Marketing</option>
                <option>Travel</option>
                <option>Other</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Description</label>
            <input name="item" required class="input w-full">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Amount</label>
            <input type="number" step="0.01" name="amount" required class="input w-full">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Date</label>
            <input type="date" name="date"
                   value="{{ now()->toDateString() }}"
                   class="input w-full">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Notes</label>
            <textarea name="notes" class="input w-full"></textarea>
        </div>

        <div class="flex gap-3">
            <button class="px-6 py-2 bg-emerald-500 text-white rounded-lg">
                Save
            </button>
            <a href="{{ route('expenses.index') }}"
               class="px-6 py-2 bg-slate-100 rounded-lg">
                Cancel
            </a>
        </div>
    </form>
</div>
</x-app-layout>
