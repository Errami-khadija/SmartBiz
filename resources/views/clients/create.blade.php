<x-app-layout>

<!-- Add Client Form -->
<div
    id="client-form-container"
    class="mb-6 bg-white rounded-2xl border border-slate-100 p-6"
>
    <h2 class="heading-font text-xl font-bold text-slate-800 mb-4">
        Add New Client
    </h2>

    <form
        action="{{ route('clients.store') }}"
        method="POST"
        class="space-y-4"
    >
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Client Name -->
            <div>
                <label
                    for="name"
                    class="block text-sm font-medium text-slate-700 mb-2"
                >
                    Client Name
                </label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    required
                    class="w-full px-4 py-2 border border-slate-200 rounded-lg
                           focus:outline-none focus:ring-2 focus:ring-emerald-500
                           @error('name') border-red-500 @enderror"
                >

                @error('name')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label
                    for="email"
                    class="block text-sm font-medium text-slate-700 mb-2"
                >
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full px-4 py-2 border border-slate-200 rounded-lg
                           focus:outline-none focus:ring-2 focus:ring-emerald-500
                           @error('email') border-red-500 @enderror"
                >

                @error('email')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <div class="flex gap-3">
            <button
                type="submit"
                class="px-6 py-2 bg-emerald-500 text-white rounded-lg
                       hover:bg-emerald-600 transition-colors font-medium"
            >
                Add Client
            </button>

            <a
                href="{{ route('clients.index') }}"
                class="px-6 py-2 bg-slate-100 text-slate-700 rounded-lg
                       hover:bg-slate-200 transition-colors font-medium"
            >
                Cancel
            </a>
        </div>
    </form>
</div>

</x-app-layout>