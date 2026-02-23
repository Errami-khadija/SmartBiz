<x-app-layout>

    <div class="py-8">
        
        <div class="max-w-7xl mx-auto px-6">

            {{-- ===================== --}}
            {{--        STATS GRID     --}}
            {{-- ===================== --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                {{-- Revenue --}}
                <div class="stat-card card-hover bg-white rounded-2xl p-6 border border-slate-100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Total Revenue</h3>
                    <p class="heading-font text-3xl font-bold text-slate-800 mt-1">
                        ${{ number_format($totalRevenue, 2) }}
                    </p>
                    <p class="text-xs text-slate-400 mt-2">
                        vs ${{ number_format($lastMonthRevenue, 2) }} last month
                    </p>
                </div>

                {{-- Active Projects --}}
                <div class="stat-card card-hover bg-white rounded-2xl p-6 border border-slate-100">
                    <div class="mb-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /> 
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Active Projects</h3>
                    <p class="heading-font text-3xl font-bold text-slate-800 mt-1">
                        {{ $activeProjects }}
                    </p>
                </div>

                {{-- Clients --}}
                <div class="stat-card card-hover bg-white rounded-2xl p-6 border border-slate-100">
                    <div class="mb-4">
                        <div class="w-12 h-12 rounded-xl bg-violet-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Total Clients</h3>
                    <p class="heading-font text-3xl font-bold text-slate-800 mt-1">
                        {{ $totalClients }}
                    </p>
                </div>

                {{-- Hours --}}
                <div class="stat-card card-hover bg-white rounded-2xl p-6 border border-slate-100">
                    <div class="mb-4">
                        <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Hours This Month</h3>
                    <p class="heading-font text-3xl font-bold text-slate-800 mt-1">
                        {{ $hoursThisMonth }}h
                    </p>
                </div>

            </div>


            {{-- ===================== --}}
            {{-- MAIN GRID             --}}
            {{-- ===================== --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Recent Projects --}}
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                        <h2 class="heading-font text-lg font-bold text-slate-800">Recent Projects</h2>
                        <a href="{{ route('projects.index') }}"
                           class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">
                            View All
                        </a>
                    </div>

                    <div class="divide-y divide-slate-100">
                        @forelse($recentProjects as $project)
                            <div class="px-6 py-4 hover:bg-slate-50 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($project->name,0,1)) }}
                                    </div>

                                    <div class="flex-1">
                                        <h3 class="font-medium text-slate-800">
                                            {{ $project->name }}
                                        </h3>
                                        <p class="text-sm text-slate-500">
                                            {{ $project->client->name ?? '-' }}
                                        </p>
                                    </div>

                                    <div class="text-right">
                                        <p class="font-medium text-slate-800">
                                            ${{ number_format($project->budget,2) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 text-center text-slate-400">
                                No projects yet.
                            </div>
                        @endforelse
                    </div>
                </div>


                {{-- Upcoming Tasks --}}
<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100">
        <h2 class="heading-font text-lg font-bold text-slate-800">Upcoming Tasks</h2>
    </div>

    <div class="divide-y divide-slate-100">
        @forelse($upcomingTasks as $task)
            <div class="px-6 py-4 flex items-center justify-between">
                <div>
                    <p class="font-medium text-slate-800">
                        {{ $task->title }}
                    </p>
                    <p class="text-xs text-slate-400">
                        {{ $task->project->name ?? 'No Project' }}
                    </p>
                </div>
            </div>
        @empty
            <div class="p-6 text-slate-400 text-sm">
                No tasks yet.
            </div>
        @endforelse
    </div>
</div>
            </div>


            {{-- ===================== --}}
            {{-- BOTTOM GRID           --}}
            {{-- ===================== --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">

                {{-- Recent Invoices --}}
                <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                        <h2 class="heading-font text-lg font-bold text-slate-800">Recent Invoices</h2>
                        <a href="{{ route('invoices.index') }}"
                           class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">
                            View All
                        </a>
                    </div>

                    <div class="divide-y divide-slate-100">
                        @forelse($recentInvoices as $invoice)
                            <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                                <div>
                                    <p class="font-medium text-slate-800">
                                        {{ $invoice->invoice_number }}
                                    </p>
                                    <p class="text-sm text-slate-500">
                                        {{ $invoice->client->name ?? '-' }}
                                    </p>
                                </div>

                                <div class="text-right">
                                    <p class="font-medium text-slate-800">
                                        ${{ number_format($invoice->amount,2) }}
                                    </p>

                                    <span class="text-xs font-medium px-2 py-1 rounded-full
                                        {{ $invoice->status === 'paid'
                                            ? 'text-emerald-600 bg-emerald-100'
                                            : 'text-amber-600 bg-amber-100' }}">
                                        {{ ucfirst($invoice->status) }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 text-center text-slate-400">
                                No invoices yet.
                            </div>
                        @endforelse
                    </div>
                </div>


                {{-- Quick Actions --}}
                <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl p-6 text-white">
                    <h2 class="heading-font text-lg font-bold mb-4">Quick Actions</h2>

                    <div class="grid grid-cols-2 gap-4">

                        <a href="{{ route('invoices.create') }}"
                           class="flex flex-col items-center gap-3 p-4 rounded-xl bg-white/10 hover:bg-white/20 transition-colors">
                            <span class="font-medium text-sm">New Invoice</span>
                        </a>

                        <a href="{{ route('clients.create') }}"
                           class="flex flex-col items-center gap-3 p-4 rounded-xl bg-white/10 hover:bg-white/20 transition-colors">
                            <span class="font-medium text-sm">Add Client</span>
                        </a>

                        <a href="{{ route('time-entries.create') }}"
                           class="flex flex-col items-center gap-3 p-4 rounded-xl bg-white/10 hover:bg-white/20 transition-colors">
                            <span class="font-medium text-sm">Start Timer</span>
                        </a>

                        <a href="{{ route('reports.index') }}"
                           class="flex flex-col items-center gap-3 p-4 rounded-xl bg-white/10 hover:bg-white/20 transition-colors">
                            <span class="font-medium text-sm">Export Report</span>
                        </a>

                    </div>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>