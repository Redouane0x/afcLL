<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <div class="mb-10">
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">{{ $team->name }}</h1>
                @if($team->age)
                    <p class="mt-2 text-md text-gray-600">Catégorie : {{ $team->age }}</p>
                @endif
            </div>

            <div class="mb-10">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Coach</h2>
                <p class="text-gray-600">À venir...</p>
            </div>

            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Joueurs</h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                    {{-- LA SEULE ET UNIQUE BOUCLE --}}
                    @forelse($team->users as $player)
                        <a href="{{ route('players.show', $player->id) }}" class="player-card">
                            <div class="player-img flex items-center justify-center text-green-700 font-bold text-4xl">
                                {{ strtoupper(substr($player->name, 0, 1)) }}
                            </div>
                            <p class="font-bold text-gray-800">{{ $player->name }}</p>
                        </a>
                    @empty
                        <div class="col-span-full py-10 bg-white rounded-xl border border-gray-200 text-center">
                            <p class="text-gray-500">Aucun joueur n'a encore été assigné à cette équipe.</p>
                        </div>
                    @endforelse

                </div>
            </div>

        </div>
    </div>
</x-app-layout>

<style>
    .player-card {
        background: white;
        border-radius: 12px;
        padding: 15px;
        text-align: center;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        transition: 0.3s;
        display: block; /* Essentiel pour que tout le bloc soit cliquable */
        text-decoration: none;
    }

    .player-img {
        height: 120px;
        background: #dcfce7; /* Vert très clair */
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .player-card:hover {
        transform: translateY(-5px);
    }
</style>
