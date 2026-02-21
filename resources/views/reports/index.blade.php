<x-app-layout>

<div class="mb-6">
    <h1 class="heading-font text-3xl font-bold text-slate-800">Reports & Analytics</h1>
    <p class="text-slate-500 mt-1">View insights about your business performance</p>
</div>

{{-- Revenue + Top Clients --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

    {{-- Revenue Overview --}}
    <div class="bg-white rounded-2xl p-6 border border-slate-100">
        <h2 class="heading-font text-lg font-bold text-slate-800 mb-4">Revenue Overview</h2>

        <div class="space-y-4">
            @foreach($months as $month)
                <div class="flex items-center justify-between">
                    <span class="text-slate-600">{{ $month['month'] }}</span>
                    <span class="font-bold text-slate-800">
                        ${{ number_format($month['total'], 2) }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Top Clients --}}
    <div class="bg-white rounded-2xl p-6 border border-slate-100">
        <h2 class="heading-font text-lg font-bold text-slate-800 mb-4">Top Clients by Revenue</h2>

        <div class="space-y-4">
            @foreach($topClients as $client)
               @php
$percentage = $totalRevenue > 0
    ? round(($client->total_revenue / $totalRevenue) * 100)
    : 0;
@endphp

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-medium text-slate-800">{{ $client->name }}</span>
                        <span class="font-bold text-slate-800">
                            ${{ number_format($client->total_revenue, 2) }}
                        </span>
                    </div>

                    <div class="w-full h-2 bg-slate-200 rounded-full overflow-hidden">
                        <div class="h-full bg-emerald-500 rounded-full"
                             style="width: {{ $percentage }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Status Cards --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Project Status --}}
    <div class="bg-white rounded-2xl p-6 border border-slate-100">
        <h3 class="heading-font font-bold text-slate-800 mb-4">Project Status</h3>
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-slate-600">Active</span>
                <span class="font-bold text-emerald-600">{{ $activeProjects }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-600">Completed</span>
                <span class="font-bold text-blue-600">{{ $completedProjects }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-600">On Hold</span>
                <span class="font-bold text-amber-600">{{ $onHoldProjects }}</span>
            </div>
        </div>
    </div>

    {{-- Payment Status --}}
    <div class="bg-white rounded-2xl p-6 border border-slate-100">
        <h3 class="heading-font font-bold text-slate-800 mb-4">Payment Status</h3>
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-slate-600">Paid</span>
                <span class="font-bold text-emerald-600">${{ number_format($paid,2) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-600">Pending</span>
                <span class="font-bold text-amber-600">${{ number_format($pending,2) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-600">Overdue</span>
                <span class="font-bold text-rose-600">${{ number_format($overdue,2) }}</span>
            </div>
        </div>
    </div>

    {{-- Time Breakdown --}}
    <div class="bg-white rounded-2xl p-6 border border-slate-100">
        <h3 class="heading-font font-bold text-slate-800 mb-4">Time Breakdown</h3>
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-slate-600">Billable</span>
                <span class="font-bold text-emerald-600">{{ $billableHours }}h</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-600">Non-billable</span>
                <span class="font-bold text-slate-600">{{ $nonBillableHours }}h</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-600">Total</span>
                <span class="font-bold text-slate-800">
                    {{ $billableHours + $nonBillableHours }}h
                </span>
            </div>
        </div>
    </div>
</div>

{{-- Export Buttons --}}
<div class="mt-6 flex gap-4">
    <a href="{{ route('reports.export.pdf') }}"
       class="flex-1 px-6 py-3 bg-emerald-500 text-white rounded-xl font-medium hover:bg-emerald-600 transition-colors text-center">
        Export PDF Report
    </a>

    <a href="{{ route('reports.export.csv') }}"
       class="flex-1 px-6 py-3 bg-slate-100 text-slate-700 rounded-xl font-medium hover:bg-slate-200 transition-colors text-center">
        Export CSV Data
    </a>
</div>

</x-app-layout>