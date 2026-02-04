<x-app-layout>

{{-- Page Header --}}
<div class="mb-6 flex items-center justify-between">
 <x-page-header
    title="Clients"
    subtitle="Manage your clients and their status"
/>


  <a href="{{ route('clients.create') }}"
     class="flex items-center gap-2 px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-medium transition-colors">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 4v16m8-8H4"/>
    </svg>
    Add Client
  </a>
</div>

{{-- Clients Table --}}
<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
  <table class="w-full">
    <thead class="bg-slate-50 border-b border-slate-100">
      <tr>
        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Client</th>
        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Contact</th>
        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Active Projects</th>
        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Total Value</th>
        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Status</th>
        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Actions</th>
      </tr>
    </thead>

    <tbody class="divide-y divide-slate-100">
      @forelse ($clients as $client)
        <tr class="hover:bg-slate-50 transition-colors">
          {{-- Client --}}
          <td class="px-6 py-4">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-full bg-gradient-to-br from-violet-400 to-purple-500 flex items-center justify-center text-white font-bold">
                {{ strtoupper(substr($client->name, 0, 1)) }}
              </div>
              <p class="font-medium text-slate-800">{{ $client->name }}</p>
            </div>
          </td>

          {{-- Contact --}}
          <td class="px-6 py-4 text-slate-600">
            {{ $client->email ?? '—' }}
          </td>

          {{-- Active Projects --}}
          <td class="px-6 py-4 text-slate-800 font-medium">
           {{ $client->active_projects_count }}
          </td>

          {{-- Total Value (future-ready) --}}
          <td class="px-6 py-4 text-slate-800 font-bold">
            ${{ number_format($client->projects()->sum('budget'), 2) }} 
          </td>

          {{-- Status --}}
          <td class="px-6 py-4">
            <span class="text-xs font-medium px-2 py-1 rounded-full
              {{ $client->status === 'active'
                  ? 'text-emerald-600 bg-emerald-100'
                  : 'text-slate-600 bg-slate-200' }}">
              {{ ucfirst($client->status) }}
            </span>
          </td>

          {{-- Actions --}}
           <td class="px-6 py-4">
              <div class="flex gap-2">

              {{-- View --}}
              <a href="{{ route('clients.show', $client->id) }}"
                 class="text-emerald-600 hover:text-emerald-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
              </a>

              {{-- Edit --}}
              <button onclick="openEditModal({{ $client->id }})"
                 class="text-blue-600 hover:text-blue-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
              </button>

              {{-- Delete --}}
              <form action="{{ route('clients.destroy', $client->id) }}"
                    method="POST"
                    class="delete-client-form">
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
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="px-6 py-8 text-center text-slate-500">
            No clients found.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
 @include('clients._edit-modal', ['client' => $client])
</x-app-layout>
