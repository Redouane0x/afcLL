<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            ➕ Ajouter une image
        </h2>
    </x-slot>

    <div class="p-8 max-w-3xl mx-auto">

        <form method="POST" action="{{ route('gallery.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- IMAGE --}}
            <div class="mb-4">
                <input type="file" name="image" required>
            </div>

            {{-- DESCRIPTION --}}
            <div class="mb-4">
                <textarea name="description"
                          placeholder="Description..."
                          class="w-full border p-2 rounded"></textarea>
            </div>

            {{-- 🔥 MENTIONS MULTIPLES --}}
            <div class="mb-4">
                <p class="font-semibold mb-2">Mentionner des joueurs</p>

                <div class="grid grid-cols-2 gap-2 max-h-40 overflow-y-auto border p-3 rounded">

                    @foreach(\App\Models\User::all() as $user)
                        <label class="flex items-center gap-2">
                            <input type="checkbox"
                                   name="mentions[]"
                                   value="{{ $user->id }}">
                            {{ $user->name }}
                        </label>
                    @endforeach

                </div>
            </div>

            <button class="bg-green-600 text-white px-4 py-2 rounded">
                Publier
            </button>

        </form>

    </div>

</x-app-layout>
