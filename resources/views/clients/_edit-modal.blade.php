<div
  id="editClientModal"
  class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50"
>
  <div class="bg-white rounded-2xl w-full max-w-xl mx-4 p-6 relative">

    {{-- Close --}}
    <button
      onclick="closeEditModal()"
      class="absolute top-4 right-4 text-slate-400 hover:text-slate-600"
    >
      ✕
    </button>

    <h2 class="text-2xl font-bold text-slate-800 mb-6">
      Edit Client
    </h2>

    <form method="POST" action="{{ route('clients.update', $client->id) }}">
      @csrf
      @method('PUT')

      <div class="space-y-4">

        <div>
          <label class="block text-sm font-medium text-slate-600 mb-1">
            Name
          </label>
          <input
            type="text"
            name="name"
            value="{{ old('name', $client->name) }}"
            class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500"
            required
          />
        </div>

        <div>
          <label class="block text-sm font-medium text-slate-600 mb-1">
            Email
          </label>
          <input
            type="email"
            name="email"
            value="{{ old('email', $client->email) }}"
            class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500"
          />
        </div>

        <div>
          <label class="block text-sm font-medium text-slate-600 mb-1">
            Status
          </label>
          <select
            name="status"
            class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500"
          >
            <option value="active" {{ $client->status === 'active' ? 'selected' : '' }}>
              Active
            </option>
            <option value="inactive" {{ $client->status === 'inactive' ? 'selected' : '' }}>
              Inactive
            </option>
          </select>
        </div>

      </div>

      <div class="flex justify-end gap-3 mt-6">
        <button
          type="button"
          onclick="closeEditModal()"
          class="px-5 py-2 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200"
        >
          Cancel
        </button>

        <button
          type="submit"
          class="px-5 py-2 bg-emerald-500 text-white rounded-xl hover:bg-emerald-600"
        >
          Save Changes
        </button>
      </div>
    </form>

  </div>
</div>



