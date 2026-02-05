<x-app-layout>
    {{-- Page Header --}}
    <div class="mb-6 flex items-center justify-between">
        <x-page-header
            title="Invoices"
            subtitle="Track invoices and payment statuses"
        />

        

        <a
            href="{{ route('invoices.create') }}"
            class="flex items-center gap-2 px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-medium transition-colors"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4v16m8-8H4"/>
            </svg>
            New Invoice
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    {{-- Paid --}}
    <div class="bg-white rounded-2xl p-6 border border-slate-100">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <span class="text-sm font-medium text-slate-600">Paid</span>
        </div>

        <p class="heading-font text-3xl font-bold text-slate-800">
            ${{ number_format($paidTotal, 2) }}
        </p>

        <p class="text-sm text-slate-500 mt-1">
            {{ $paidCount }} invoices
        </p>
    </div>

    {{-- Pending --}}
    <div class="bg-white rounded-2xl p-6 border border-slate-100">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <span class="text-sm font-medium text-slate-600">Pending</span>
        </div>

        <p class="heading-font text-3xl font-bold text-slate-800">
            ${{ number_format($pendingTotal, 2) }}
        </p>

        <p class="text-sm text-slate-500 mt-1">
            {{ $pendingCount }} invoices
        </p>
    </div>

    {{-- Overdue --}}
    <div class="bg-white rounded-2xl p-6 border border-slate-100">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-lg bg-rose-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <span class="text-sm font-medium text-slate-600">Overdue</span>
        </div>

        <p class="heading-font text-3xl font-bold text-slate-800">
            ${{ number_format($overdueTotal, 2) }}
        </p>

        <p class="text-sm text-slate-500 mt-1">
            {{ $overdueCount }} invoices
        </p>
    </div>

</div>


    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Invoice</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Client</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Date</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Amount</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($invoices as $invoice)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-800">
    {{ $invoice->invoice_id }}
</td>

<td class="px-6 py-4 text-slate-600">
    {{ $invoice->client->name ?? '—' }}
</td>

<td class="px-6 py-4 text-slate-600">
    {{ optional($invoice->invoice_date)->format('Y-m-d') }}
</td>

<td class="px-6 py-4 font-bold text-slate-800">
    ${{ number_format($invoice->amount, 2) }}
</td>

<td class="px-6 py-4">
    @php
        $statusStyles = [
            'Paid' => 'text-emerald-600 bg-emerald-100',
            'Pending' => 'text-amber-600 bg-amber-100',
            'Overdue' => 'text-rose-600 bg-rose-100',
        ];
    @endphp

    <span class="text-xs font-medium px-2 py-1 rounded-full
        {{ $statusStyles[$invoice->status] ?? 'text-slate-600 bg-slate-200' }}">
        {{ $invoice->status }}
    </span>
</td>

<td class="px-6 py-4">
    <a href="{{ route('invoices.show', $invoice->id) }}"
       class="text-emerald-600 hover:text-emerald-700 font-medium text-sm">
        View
    </a>
    <a href="{{ route('invoices.download', $invoice->id) }}"
       class="ml-4 text-blue-600 hover:text-blue-800 font-medium text-sm">
        download
    </a>
   <form action="{{ route('invoices.destroy', $invoice->id) }}"
      method="POST"
      class="inline ml-4 delete-invoice-form">
    @csrf
    @method('DELETE')

    <button type="submit"
            class="text-rose-600 hover:text-rose-800 font-medium text-sm">
        Delete
    </button>
</form>

</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                            No invoices available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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