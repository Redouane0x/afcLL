<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            ✏️ Modifier le post
        </h2>
    </x-slot>

    <div class="p-8 max-w-3xl mx-auto">

        <form method="POST"
              action="{{ route('gallery.update', $image->id) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- IMAGE --}}
            <div class="mb-4">
                <p class="mb-2">Image actuelle :</p>
                <img src="{{ asset('storage/'.$image->image_url) }}"
                     class="w-40 rounded mb-2">

                <input type="file" name="image">
            </div>

            {{-- DESCRIPTION --}}
            <div class="mb-4">
                <textarea name="description"
                          class="w-full border p-2 rounded">{{ $image->description }}</textarea>
            </div>

            {{-- MENTIONS --}}
            <div class="mb-4">
                <p class="font-semibold mb-2">Mentionner</p>

                <div class="grid grid-cols-2 gap-2 max-h-40 overflow-y-auto border p-3 rounded">

                    @foreach(\App\Models\User::all() as $user)
                        <label class="flex items-center gap-2">
                            <input type="checkbox"
                                   name="mentions[]"
                                   value="{{ $user->id }}"
                                {{ $image->mentions->pluck('user_id')->contains($user->id) ? 'checked' : '' }}>
                            {{ $user->name }}
                        </label>
                    @endforeach

                </div>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Mettre à jour
            </button>

        </form>

    </div>

</x-app-layout>
