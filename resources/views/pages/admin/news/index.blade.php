<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">🛠️ Gestion des actualités</h2>
    </x-slot>

    <div class="p-8 max-w-6xl mx-auto">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-6">
            <p class="text-gray-600">
                Liste des actualités
            </p>

            <a href="{{ route('admin.news.create') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow">
                ➕ Ajouter une actualité
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

                        <div class="flex gap-3 items-center">

                            {{-- FEATURE --}}
                            @if($item->is_featured)
                                <span class="text-yellow-500 font-bold">⭐</span>
                            @endif

                            {{-- DELETE --}}
                            <form method="POST"
                                  action="{{ route('admin.news.delete', $item->id) }}">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Supprimer ?')"
                                        class="text-red-500 text-sm">
                                    Supprimer
                                </button>
                            </form>

                        </div>

                    </div>

                    <p class="mt-3 text-gray-600">
                        {{ \Illuminate\Support\Str::limit($item->content, 150) }}
                    </p>

                </div>

            @empty

                <div class="text-center text-gray-500">
                    Aucune actualité
                </div>

            @endforelse

        </div>

    </div>

</x-app-layout>
