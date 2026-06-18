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

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    {{-- On boucle sur les vrais joueurs de l'équipe --}}
                    @forelse($team->users as $player)
                        <div class="bg-white rounded-xl shadow-sm p-4 flex flex-col items-center border border-gray-100 hover:shadow-md transition-shadow">
                            <div class="bg-gray-200 w-full h-40 rounded-lg mb-4 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            </div>

                            <span class="text-gray-900 font-medium text-lg">{{ $player->name }}</span>
                        </div>
                    @empty
                        {{-- S'il n'y a aucun joueur dans l'équipe pour l'instant --}}
                        <div class="col-span-full py-10 bg-white rounded-xl border border-gray-200 text-center">
                            <p class="text-gray-500">Aucun joueur n'a encore été assigné à cette équipe pour le moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
