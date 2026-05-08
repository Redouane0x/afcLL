<x-app-layout>

    <x-slot name="header">
        <h2 class="text-3xl font-bold">📰 Actualités</h2>
    </x-slot>

    <div class="p-8 max-w-6xl mx-auto space-y-10">

        {{-- FEATURED --}}
        @if($featured)
            <div class="bg-white rounded-2xl shadow overflow-hidden">

                @if($featured->image)
                    <img src="{{ asset('storage/'.$featured->image) }}"
                         class="w-full h-80 object-cover">
                @endif

                <div class="p-6">
                    <span class="text-yellow-500 font-bold">⭐ À la une</span>

                    <h2 class="text-2xl font-bold mt-2">
                        {{ $featured->title }}
                    </h2>

                    <p class="mt-3 text-gray-600">
                        {{ $featured->content }}
                    </p>
                </div>

            </div>
        @endif

        {{-- LISTE --}}
        <div class="grid md:grid-cols-2 gap-6">

            @foreach($news as $item)

                @if(!$featured || $item->id !== $featured?->id)

                    <div class="bg-white p-5 rounded-xl shadow">

                        @if($item->image)
                            <img src="{{ asset('storage/'.$item->image) }}"
                                 class="mb-3 rounded h-40 w-full object-cover">
                        @endif

                        <h3 class="font-bold text-lg">
                            {{ $item->title }}
                        </h3>

                        <p class="text-sm text-gray-600 mt-2">
                            {{ \Illuminate\Support\Str::limit($item->content, 120) }}
                        </p>

                        {{-- ❤️ LIKE --}}
                        @auth
                            <form method="POST" action="{{ route('news.like', $item->id) }}">
                                @csrf
                                <button class="text-red-500 font-semibold mt-2">
                                    ❤️ {{ $item->likes->count() }}
                                </button>
                            </form>
                        @endauth

                        {{-- 💬 COMMENTAIRES --}}
                        <div class="mt-4 space-y-2">
                            @foreach($item->comments as $comment)
                                <p class="text-sm">
                                    <strong>{{ $comment->user->name }} :</strong>
                                    {{ $comment->content }}
                                </p>
                            @endforeach
                        </div>

                        {{-- ✍️ AJOUT COMMENT --}}
                        @auth
                            <form method="POST"
                                  action="{{ route('news.comment', $item->id) }}"
                                  class="mt-3">
                                @csrf

                                <input name="content"
                                       placeholder="Commenter..."
                                       class="w-full border p-2 rounded">
                            </form>
                        @endauth

                    </div>

                @endif

            @endforeach

        </div>

    </div>

</x-app-layout>
