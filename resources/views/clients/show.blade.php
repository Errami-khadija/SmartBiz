<x-app-layout>
  <div class="max-w-6xl mx-auto px-6 py-10">

    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-8">
      <div class="flex items-center gap-4">
        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-violet-400 to-purple-500 flex items-center justify-center text-white font-bold text-2xl">
          {{ strtoupper(substr($client->name, 0, 1)) }}
        </div>
        <div>
          <h1 class="heading-font text-3xl font-bold text-slate-800">
            {{ $client->name }}
          </h1>
          <p class="text-slate-500">{{ $client->email ?? '—' }}</p>
        </div>
      </div>

      <a href="{{ route('clients.index') }}"
         class="text-sm text-slate-500 hover:text-slate-700">
        ← Back to clients
      </a>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl shadow-sm p-8">

      {{-- Stats --}}
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
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
      <div class="border-t pt-6 mb-8">
        <h3 class="font-bold text-slate-800 mb-4">Client Information</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <p class="text-slate-500 text-sm">Client Name</p>
            <p class="font-medium text-slate-800">{{ $client->name }}</p>
          </div>

          <div>
            <p class="text-slate-500 text-sm">Email</p>
            <p class="font-medium text-slate-800">{{ $client->email ?? '—' }}</p>
          </div>

          <div>
            <p class="text-slate-500 text-sm">Client ID</p>
            <p class="font-medium text-slate-800">
              #CLT-{{ str_pad($client->id, 4, '0', STR_PAD_LEFT) }}
            </p>
          </div>

          <div>
            <p class="text-slate-500 text-sm">Member Since</p>
            <p class="font-medium text-slate-800">
              {{ $client->created_at->format('M Y') }}
            </p>
          </div>
        </div>
      </div>

      {{-- Recent Projects --}}
      <div class="border-t pt-6 mb-8">
        <h3 class="font-bold text-slate-800 mb-4">Recent Projects</h3>

        <div class="space-y-2">
          @forelse ($client->projects as $project)
            <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg">
              <span class="text-slate-700">{{ $project->name }}</span>
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
      <div class="flex gap-4">
       <button
          onclick="openEditModal()"
           class="px-6 py-3 bg-emerald-500 text-white rounded-xl font-medium hover:bg-emerald-600"
          >
          Edit Client
        </button>
      </div>

    </div>
  </div>
  @include('clients._edit-modal')

</x-app-layout>

@if (session('success') && session('from_update'))
<script>
  Swal.fire({
    icon: 'success',
    title: 'Success',
    text: "{{ session('success') }}",
    confirmButtonColor: '#10b981',
  })
</script>
@endif

