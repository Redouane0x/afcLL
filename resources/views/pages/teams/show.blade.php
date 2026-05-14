<x-app-layout>

    <div class="max-w-6xl mx-auto py-12 px-6">

        <h1 class="text-4xl font-bold mb-4">
            {{ $team['name'] }}
        </h1>

        <p class="text-gray-500 mb-10">
            Catégorie : {{ $team['age'] }}
        </p>

        {{-- COACH --}}
        <div class="mb-10">
            <h2 class="text-2xl font-bold mb-4">Coach</h2>
            <p class="text-gray-600">
                À venir...
            </p>
        </div>

        {{-- JOUEURS --}}
        <div>
            <h2 class="text-2xl font-bold mb-6">Joueurs</h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                @for($i = 0; $i < 8; $i++)
                    <div class="player-card">
                        <div class="player-img"></div>
                        <p>Joueur</p>
                    </div>
                @endfor

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
    }

    .player-img {
        height: 120px;
        background: #eee;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .player-card:hover {
        transform: translateY(-5px);
    }
</style>
