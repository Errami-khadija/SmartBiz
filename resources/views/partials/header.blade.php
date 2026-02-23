<!-- Header -->
    <header class="bg-white border-b border-slate-200 px-8 py-4 sticky top-0 z-10">
     <div class="flex items-center justify-between">
      <div>
      <h1 id="welcome-text" class="heading-font text-2xl font-bold text-slate-800">
    Welcome back, {{ auth()->user()->name ?? 'Guest' }}!
</h1>
       <p class="text-slate-500 mt-1">Here's what's happening with your business today.</p>
      </div>
      <div class="flex items-center gap-4">
        
         @include('layouts.navigation')
      </div>
     </div>
    </header>