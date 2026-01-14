<div class="modal-backdrop fixed inset-0 bg-black/50 flex items-center justify-center z-50">
  <div class="modal-content bg-white rounded-2xl p-8 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">

    {{-- Header --}}
    <div class="flex items-start justify-between mb-6">
      <div class="flex items-center gap-4">
        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-violet-400 to-purple-500 flex items-center justify-center text-white font-bold text-2xl">
          {{ strtoupper(substr($client->name, 0, 1)) }}
        </div>
        <div>
          <h2 class="heading-font text-2xl font-bold text-slate-800">
            {{ $client->name }}
          </h2>
          <p class="text-slate-500">{{ $client->email ?? '—' }}</p>
        </div>
      </div>

      <a href="{{ route('clients.index') }}" class="text-slate-400 hover:text-slate-600">
        ✕
      </a>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-3 gap-4 mb-6">
      <div class="bg-slate-50 rounded-xl p-4">
        <p class="text-sm text-slate-600 mb-1">Active Projects</p>
        <p class="heading-font text-2xl font-bold text-slate-800">
          {{ $activeProjectsCount }}
        </p>
      </div>

      <div class="bg-slate-50 rounded-xl p-4">
        <p class="text-sm text-slate-600 mb-1">Total Value</p>
        <p class="heading-font text-2xl font-bold text-slate-800">
          ${{ number_format($totalValue, 2) }}
        </p>
      </div>

      <div class="bg-slate-50 rounded-xl p-4">
        <p class="text-sm text-slate-600 mb-1">Status</p>
        <span class="inline-block text-sm font-medium px-3 py-1 rounded-full
          {{ $client->status === 'active'
              ? 'text-emerald-600 bg-emerald-100'
              : 'text-slate-600 bg-slate-200' }}">
          {{ ucfirst($client->status) }}
        </span>
      </div>
    </div>

    {{-- Client Info --}}
    <div class="border-t pt-6 mb-6">
      <h3 class="font-bold text-slate-800 mb-4">Client Information</h3>

      <div class="space-y-3">
        <div class="flex justify-between">
          <span class="text-slate-600">Client Name</span>
          <span class="font-medium text-slate-800">{{ $client->name }}</span>
        </div>

        <div class="flex justify-between">
          <span class="text-slate-600">Email</span>
          <span class="font-medium text-slate-800">{{ $client->email ?? '—' }}</span>
        </div>

        <div class="flex justify-between">
          <span class="text-slate-600">Client ID</span>
          <span class="font-medium text-slate-800">
            #CLT-{{ str_pad($client->id, 4, '0', STR_PAD_LEFT) }}
          </span>
        </div>

        <div class="flex justify-between">
          <span class="text-slate-600">Member Since</span>
          <span class="font-medium text-slate-800">
            {{ $client->created_at->format('M Y') }}
          </span>
        </div>
      </div>
    </div>

    {{-- Recent Projects --}}
    <div class="border-t pt-6 mb-6">
      <h3 class="font-bold text-slate-800 mb-4">Recent Projects</h3>

      <div class="space-y-2">
        @forelse ($client->projects as $project)
          <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg">
            <span class="text-slate-700">{{ $project->title }}</span>
            <span class="text-sm font-medium
              {{ $project->status === 'in_progress'
                  ? 'text-emerald-600'
                  : 'text-blue-600' }}">
              {{ ucfirst(str_replace('_', ' ', $project->status)) }}
            </span>
          </div>
        @empty
          <p class="text-slate-500 text-sm">No projects yet.</p>
        @endforelse
      </div>
    </div>

    {{-- Actions --}}
    <div class="flex gap-3">
      <a href="{{ route('clients.index') }}"
         class="flex-1 px-6 py-3 bg-slate-100 text-slate-700 rounded-xl font-medium hover:bg-slate-200 text-center">
        Close
      </a>

      <a href="{{ route('clients.edit', $client->id) }}"
         class="flex-1 px-6 py-3 bg-emerald-500 text-white rounded-xl font-medium hover:bg-emerald-600 text-center">
        Edit Client
      </a>
    </div>

  </div>
</div>
