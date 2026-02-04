<x-app-layout>
    {{-- Page Header --}}
    <div class="mb-6 flex items-center justify-between">
        <x-page-header
            title="New Invoice"
            subtitle="Create a new invoice for your client"
        />

        <a href="{{ route('invoices.index') }}"
           class="px-4 py-2 bg-slate-100 text-slate-700 rounded-xl font-medium hover:bg-slate-200">
            Back to Invoices
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 p-8">
        <form class="space-y-6" method="POST" action="{{ route('invoices.store') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Client</label>
                    <select
                      name="client_id"
                        required
                        class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"
                    >
                        <option value="">Select a client</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Invoice Date</label>
                   <input
                     type="date"
                     name="invoice_date"
                     class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"
                 />
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Amount</label>
                    <input
                        type="number"
                        min="0"
                        step="0.01"
                        name="amount"
                        placeholder="0.00"
                        class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"
                    />
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                    <select
                        name="status"
                        class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"
                    >
                        <option value="">Select status</option>
                        <option value="Paid">Paid</option>
                        <option value="Pending">Pending</option>
                        <option value="Overdue">Overdue</option>
                    </select>
                </div>
            </div>


            <div class="flex gap-3">
                <button
                    type="submit"
                    class="px-6 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600"
                >
                    Save Invoice
                </button>
                <a
                    href="{{ route('invoices.index') }}"
                    class="px-6 py-2 bg-slate-100 text-slate-700 rounded-lg"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>