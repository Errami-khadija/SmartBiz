<!-- Header -->
    <header class="bg-white border-b border-slate-200 px-8 py-4 sticky top-0 z-10">
     <div class="flex items-center justify-between">
      <div>
       <h1 id="welcome-text" class="heading-font text-2xl font-bold text-slate-800">Welcome back, Alex! 👋</h1>
       <p class="text-slate-500 mt-1">Here's what's happening with your business today.</p>
      </div>
      <div class="flex items-center gap-4"><!-- Search -->
       <div class="relative"><input type="text" placeholder="Search..." class="w-64 pl-10 pr-4 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
        <svg class="w-5 h-5 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
       </div><!-- Notifications --> 
       <button class="relative p-2 rounded-xl hover:bg-slate-100 transition-colors">
        <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg><span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full pulse-dot"></span> </button> 
        <!-- New Button --> 
         @include('layouts.navigation')
      </div>
     </div>
    </header>