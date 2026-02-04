<x-app-layout>
    {{-- Page Header --}}
    <div class="mb-6 flex items-center justify-between">
        <x-page-header
            title="Invoice {{ $invoice->invoice_id }}"
            subtitle="Review invoice details and status"
        />

        <div class="flex gap-2">
            <a href="{{ route('invoices.download', $invoice->id) }}"
               class="px-4 py-2 bg-emerald-500 text-white rounded-xl font-medium hover:bg-emerald-600">
                Download PDF
            </a>

            <a href="{{ route('invoices.index') }}"
               class="px-4 py-2 bg-slate-100 text-slate-700 rounded-xl font-medium hover:bg-slate-200">
                Back to Invoices
            </a>
        </div>
    </div>

    {{-- Invoice Card --}}
    <div id="invoice-content" class="bg-white rounded-2xl border border-slate-100 p-8">
        {{-- Top Info --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8">
            <div>
                <p class="text-sm text-slate-500">Client</p>
                <p class="text-2xl font-bold text-slate-800">
                    {{ $invoice->client->name }}
                </p>
            </div>

            <div class="flex gap-6">
                <div>
                    <p class="text-sm text-slate-500">Invoice Date</p>
                    <p class="font-medium text-slate-800">
                        {{ optional($invoice->invoice_date)->format('Y-m-d') }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Amount</p>
                    <p class="text-xl font-bold text-slate-800">
                        ${{ number_format($invoice->amount, 2) }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Status --}}
        @php
            $statusStyles = [
                'Paid' => 'text-emerald-600 bg-emerald-100',
                'Pending' => 'text-amber-600 bg-amber-100',
                'Overdue' => 'text-rose-600 bg-rose-100',
            ];
        @endphp

        <div class="flex items-center gap-2 mb-8">
            <span class="text-sm text-slate-500">Status</span>
            <span class="text-xs font-medium px-2 py-1 rounded-full
                {{ $statusStyles[$invoice->status] ?? 'text-slate-600 bg-slate-200' }}">
                {{ $invoice->status }}
            </span>
        </div>

        {{-- Summary --}}
        <div class="border-t pt-6">
            <div class="flex items-center justify-between bg-emerald-50 rounded-xl border border-emerald-200 p-5">
                <p class="font-semibold text-slate-800">Total Amount</p>
                <p class="text-xl font-bold text-emerald-600">
                    ${{ number_format($invoice->amount, 2) }}
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
