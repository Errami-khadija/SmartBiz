<div
  id="editProjectModal"
  class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50"
>
  <div class="bg-white rounded-2xl w-full max-w-xl mx-4 p-6 relative">

    {{-- Close --}}
    <button
      onclick="closeEditProjectModal()"
      class="absolute top-4 right-4 text-slate-400 hover:text-slate-600"
    >
      ✕
    </button>

    <h2 class="text-2xl font-bold text-slate-800 mb-6">
      Edit Project
    </h2>

    <form method="POST" action="{{ route('projects.update', $project->id) }}">
      @csrf
      @method('PUT')

      <div class="space-y-4">

        {{-- Project Name --}}
        <div>
          <label class="block text-sm font-medium text-slate-600 mb-1">
            Project Name
          </label>
          <input
            type="text"
            name="name"
            value="{{ old('name', $project->name) }}"
            class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500"
            required
          />
        </div>

        {{-- Description --}}
        <div>
          <label class="block text-sm font-medium text-slate-600 mb-1">
            Description
          </label>
          <textarea
            name="description"
            rows="3"
            class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500"
          >{{ old('description', $project->description) }}</textarea>
        </div>

        {{-- Status --}}
        <div>
          <label class="block text-sm font-medium text-slate-600 mb-1">
            Status
          </label>
          <select
            name="status"
            class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500"
          >
            <option value="pending" {{ $project->status === 'pending' ? 'selected' : '' }}>
              Pending
            </option>
            <option value="in_progress" {{ $project->status === 'in_progress' ? 'selected' : '' }}>
              In Progress
            </option>
            <option value="completed" {{ $project->status === 'completed' ? 'selected' : '' }}>
              Completed
            </option>
          </select>
        </div>

        {{-- Dates --}}
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-slate-600 mb-1">
              Start Date
            </label>
            <input
              type="date"
              name="start_date"
              value="{{ old('start_date', $project->start_date) }}"
              class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-slate-600 mb-1">
              End Date
            </label>
            <input
              type="date"
              name="end_date"
              value="{{ old('end_date', $project->end_date) }}"
              class="w-full rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500"
            />
          </div>
        </div>

      </div>

      <div class="flex justify-end gap-3 mt-6">
        <button
          type="button"
          onclick="closeEditProjectModal()"
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
