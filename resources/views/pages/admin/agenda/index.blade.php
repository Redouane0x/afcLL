<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Gestion de l'Agenda</h1>
                <p class="mt-2 text-sm text-gray-600">Ajoutez manuellement les prochains matchs, entraînements ou événements du club.</p>
            </div>

            @if (session('success'))
                <div class="mb-8 bg-green-50 border-l-4 border-green-500 p-4 rounded-md shadow-sm">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- FORMULAIRE DE CRÉATION -->
                <div class="md:col-span-1">
                    <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Nouvel Événement</h2>

                        <form action="{{ route('admin.agenda.store') }}" method="POST" class="space-y-4">
                            @csrf

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Titre (ex: U18 vs Lens)</label>
                                <input type="text" name="titre" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Type d'événement</label>
                                <select name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="Match">Match</option>
                                    <option value="Entraînement">Entraînement</option>
                                    <option value="Tournoi">Tournoi</option>
                                    <option value="Réunion">Réunion / Autre</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Date et Heure</label>
                                <input type="datetime-local" name="date_heure" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Lieu (Stade, Domicile...)</label>
                                <input type="text" name="lieu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Description / Infos (optionnel)</label>
                                <textarea name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                            </div>

                            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                                Ajouter à l'agenda
                            </button>
                        </form>
                    </div>
                </div>

                <!-- LISTE DES ÉVÉNEMENTS -->
                <div class="md:col-span-2">
                    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden p-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Événements prévus</h2>

                        <div class="space-y-4">
                            @forelse($events as $event)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-100">
                                    <div>
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                                {{ $event->type === 'Match' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $event->type === 'Entraînement' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $event->type === 'Tournoi' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $event->type === 'Réunion' ? 'bg-purple-100 text-purple-800' : '' }}">
                                                {{ $event->type }}
                                            </span>
                                            <span class="text-sm text-gray-500 font-medium">
                                                {{ $event->date_heure->format('d/m/Y à H:i') }}
                                            </span>
                                        </div>
                                        <h3 class="text-md font-bold text-gray-900">{{ $event->titre }}</h3>
                                        @if($event->lieu)
                                            <p class="text-sm text-gray-600">📍 {{ $event->lieu }}</p>
                                        @endif
                                    </div>

                                    <form action="{{ route('admin.agenda.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Supprimer cet événement ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-sm px-3 py-1 bg-red-50 rounded-md hover:bg-red-100 transition-colors">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-4">Aucun événement n'est prévu pour le moment.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
