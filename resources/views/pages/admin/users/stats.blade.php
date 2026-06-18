<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">

            <div class="mb-6">
                <a href="{{ route('admin.users.index') }}" class="text-sm text-blue-600 hover:underline">← Retour à la liste</a>
                <h1 class="text-2xl font-bold text-gray-900 mt-2">Modifier les statistiques de {{ $user->name }}</h1>
            </div>

            <form action="{{ route('admin.users.updateStats', $user->id) }}" method="POST" class="bg-white rounded-xl shadow border p-6 space-y-6">
                @csrf
                @method('PUT')

                <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">Profil du joueur</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Poste / Position</label>
                        <input type="text" name="position" value="{{ $user->position }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Note Globale (1-99)</label>
                        <input type="number" name="rating" value="{{ $user->rating }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>

                <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">Performances (Saison)</h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Buts</label>
                        <input type="number" name="buts" value="{{ $user->buts }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Passes décisives</label>
                        <input type="number" name="passes" value="{{ $user->passes }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Matchs Gagnés</label>
                        <input type="number" name="matchs_gagnes" value="{{ $user->matchs_gagnes }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>

                <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">Détails techniques & Physiques</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Matchs Joués</label>
                        <input type="number" name="matchs_joues" value="{{ $user->matchs_joues }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Précision des passes (%)</label>
                        <input type="number" name="reussite_passes" value="{{ $user->reussite_passes }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pied fort</label>
                        <select name="pied_fort" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="Droit" {{ $user->pied_fort == 'Droit' ? 'selected' : '' }}>Droit</option>
                            <option value="Gauche" {{ $user->pied_fort == 'Gauche' ? 'selected' : '' }}>Gauche</option>
                            <option value="Ambidextre" {{ $user->pied_fort == 'Ambidextre' ? 'selected' : '' }}>Ambidextre</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Taille (ex: 1m82)</label>
                        <input type="text" name="taille" value="{{ $user->taille }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 shadow-sm transition-colors">
                        Sauvegarder les statistiques
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
