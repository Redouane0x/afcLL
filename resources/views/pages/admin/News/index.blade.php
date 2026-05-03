<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            📰 Gestion des actualités
        </h2>
    </x-slot>

    <div class="p-8 max-w-6xl mx-auto">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-6">
            <p class="text-gray-600">
                Liste des actualités
            </p>

            <a href="{{ route('admin.news') }}"
               class="bg-green-600 text-white px-4 py-2 rounded">
                ➕ Nouvelle actu
            </a>
        </div>

        {{-- LISTE --}}
        <div class="space-y-6">

            @forelse($news as $item)

                <div class="bg-white p-5 rounded-xl shadow">

                    <div class="flex justify-between items-center">

                        <div>
                            <h3 class="font-bold text-lg">
                                {{ $item->title }}
                            </h3>

                            <p class="text-sm text-gray-500">
                                {{ $item->created_at->format('d/m/Y') }}
                            </p>
                        </div>

                        {{-- STATUS --}}
                        <span class="px-3 py-1 text-sm rounded
                            {{ $item->is_published ? 'bg-green-200' : 'bg-gray-200' }}">
                            {{ $item->is_published ? 'Publié' : 'Brouillon' }}
                        </span>

                    </div>

                    {{-- IMAGE --}}
                    @if($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}"
                             class="mt-3 rounded max-h-60">
                    @endif

                    {{-- CONTENU --}}
                    <p class="mt-3 text-gray-700">
                        {{ Str::limit($item->content, 150) }}
                    </p>

                    {{-- ACTIONS --}}
                    <div class="flex gap-4 mt-4">

                        <a href="{{ route('admin.news.edit', $item->id) }}"
                           class="text-blue-600">
                            ✏️ Modifier
                        </a>

                        <form method="POST"
                              action="{{ route('admin.news.delete', $item->id) }}">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Supprimer ?')"
                                    class="text-red-500">
                                🗑 Supprimer
                            </button>
                        </form>

                    </div>

                </div>

            @empty

                <p class="text-center text-gray-500">
                    Aucune actualité
                </p>

            @endforelse

        </div>

    </div>

</x-app-layout>
