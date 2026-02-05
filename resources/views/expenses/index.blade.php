<x-app-layout>
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="heading-font text-3xl font-bold text-slate-800">Expenses</h1>
        <p class="text-slate-500 mt-1">Track your business expenses</p>
    </div>

    <a href="{{ route('expenses.create') }}"
       class="flex items-center gap-2 px-4 py-2 bg-emerald-500 text-white rounded-xl">
       <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4v16m8-8H4"/>
            </svg>
        Add Expense
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

    {{-- This Month --}}
    <div class="bg-white rounded-2xl p-6 border border-slate-100">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center">
                 <span class="text-emerald-600 font-bold text-lg">
                TM
               </span>
            </div>
        </div>
        <p class="text-sm text-slate-600 mb-1">This Month</p>
        <p class="heading-font text-3xl font-bold text-slate-800">
            ${{ number_format($thisMonth, 2) }}
        </p>
    </div>

    {{-- Last Month --}}
    <div class="bg-white rounded-2xl p-6 border border-slate-100">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
               <span class="text-blue-600 font-bold text-lg">LM</span>
            </div>
        </div>
        <p class="text-sm text-slate-600 mb-1">Last Month</p>
        <p class="heading-font text-3xl font-bold text-slate-800">
            ${{ number_format($lastMonth, 2) }}
        </p>
    </div>

    {{-- This Year --}}
    <div class="bg-white rounded-2xl p-6 border border-slate-100">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
               <span class="text-purple-600 font-bold text-lg">TY</span>
            </div>
        </div>
        <p class="text-sm text-slate-600 mb-1">This Year</p>
        <p class="heading-font text-3xl font-bold text-slate-800">
            ${{ number_format($thisYear, 2) }}
        </p>
    </div>

    {{-- Average --}}
    <div class="bg-white rounded-2xl p-6 border border-slate-100">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center">
                <span class="text-amber-600 font-bold text-lg">A</span>
            </div>
        </div>
        <p class="text-sm text-slate-600 mb-1">Average Expense</p>
        <p class="heading-font text-3xl font-bold text-slate-800">
            ${{ number_format($average ?? 0, 2) }}
        </p>
    </div>

</div>


<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
    <div class="divide-y divide-slate-100">
        @forelse($expenses as $expense)
            <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50">
                <div class="flex-1">
                    <p class="font-medium text-slate-800">{{ $expense->item }}</p>
                    <p class="text-sm text-slate-500">{{ $expense->category }}</p>
                </div>

                <div class="flex-1 text-center text-sm text-slate-600">
                    {{ $expense->date->format('M d, Y') }}
                </div>

                <div class="flex-1 text-right font-bold">
                    ${{ number_format($expense->amount, 2) }}
                </div>

                <div class="ml-4 flex gap-3">
                    <a href="{{ route('expenses.show', $expense) }}"
                       class="text-emerald-600 hover:text-emerald-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                    </a>

                    <form method="POST"
                          action="{{ route('expenses.destroy', $expense) }}"
                          class="inline ml-4 delete-expense-form">
                        @csrf
                        @method('DELETE')
                        <button class="text-rose-600 hover:text-rose-700">
                           <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                  </svg>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="p-6 text-slate-500">No expenses yet.</p>
        @endforelse
    </div>
</div>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Done',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif
</x-app-layout>
