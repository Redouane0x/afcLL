<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Galerie
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-10">

        {{-- 🔥 HEADER --}}
        <div class="flex justify-between items-center mb-10">
            <p class="text-gray-600 text-lg">
                Galerie du club
            </p>

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('gallery.create') }}"
                   class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow">
                    ➕ Ajouter un post
                </a>
            @endif
        </div>

        {{-- 📸 LISTE IMAGES --}}
        <div class="space-y-10">

            @forelse($images as $image)

                <div class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition">

                    {{-- IMAGE --}}
                    <img src="{{ asset('storage/'.$image->image_url) }}"
                         class="w-full rounded mb-3">

                    {{-- 🔥 ACTIONS ADMIN (PROPRE) --}}
                    @if(auth()->user()->role === 'admin')
                        <div class="flex gap-4 mb-3">

                            {{-- DELETE POST --}}
                            <form method="POST"
                                  action="{{ route('gallery.delete', $image->id) }}">
                                @csrf
                                @method('DELETE')

                                <button class="text-red-600 text-sm hover:underline">
                                    🗑 Supprimer
                                </button>
                            </form>

                            {{-- EDIT POST --}}
                            <a href="{{ route('gallery.edit', $image->id) }}"
                               class="text-blue-600 text-sm hover:underline">
                                ✏️ Modifier
                            </a>

                        </div>
                    @endif

                    {{-- DESCRIPTION --}}
                    @if($image->description)
                        <p class="mb-2 text-gray-700">
                            {{ $image->description }}
                        </p>
                    @endif

                    {{-- ❤️ LIKE --}}
                    <form method="POST" action="{{ route('gallery.like', $image->id) }}">
                        @csrf
                        <button class="text-red-500 font-semibold hover:scale-105 transition">
                            ❤️ {{ $image->likes->count() }}
                        </button>
                    </form>

                    {{-- 🏷️ MENTIONS --}}
                    @if($image->mentions->count())
                        <p class="text-sm text-blue-600 mt-2">
                            Mentionné :
                            @foreach($image->mentions as $mention)
                                <span class="font-semibold">
                                    {{ $mention->user?->name }}
                                </span>@if(!$loop->last), @endif
                            @endforeach
                        </p>
                    @endif

                    {{-- 💬 COMMENTAIRES --}}
                    <div class="mt-4 space-y-2">
                        @foreach($image->comments as $comment)

                            <div class="flex justify-between items-center">

                                <p class="text-sm">
                                    <strong>{{ $comment->user?->name }} :</strong>
                                    {{ $comment->content }}
                                </p>

                                {{-- DELETE COMMENT ADMIN --}}
                                @if(auth()->user()->role === 'admin')
                                    <form method="POST"
                                          action="{{ route('comment.delete', $comment->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-500 text-xs hover:underline">
                                            supprimer
                                        </button>
                                    </form>
                                @endif

                            </div>

                        @endforeach
                    </div>

                    {{-- AJOUT COMMENTAIRE --}}
                    <form method="POST"
                          action="{{ route('gallery.comment', $image->id) }}"
                          class="mt-3">
                        @csrf

                        <input name="content"
                               placeholder="Commenter..."
                               class="w-full border p-2 rounded-lg">
                    </form>

                </div>

            @empty

                <div class="text-center text-gray-500 py-20">
                    Aucune image dans la galerie
                </div>

            @endforelse

        </div>

    </div>

</x-app-layout>
