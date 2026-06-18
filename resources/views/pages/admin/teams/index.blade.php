<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Gestion des Équipes</h1>
                <p class="mt-2 text-sm text-gray-600">Gérez les effectifs du club AFCLL.</p>
            </div>

            @if (session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-md">
                    <p class="text-sm text-green-800">{{ session('success') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                    <ul class="text-sm text-red-800 list-disc list-inside">
                        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-10 bg-white rounded-xl shadow-md border border-gray-200 p-6">
                <h2 class="text-lg font-bold mb-4">Créer une nouvelle équipe</h2>
                <form action="{{ route('admin.teams.store') }}" method="POST" class="flex gap-4 items-end">
                    @csrf
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom (ex: Féminines)</label>
                        <input type="text" name="name" required class="block w-full border-gray-300 rounded-md">
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Âge (ex: +18 ans)</label>
                        <input type="text" name="age" class="block w-full border-gray-300 rounded-md">
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Créer</button>
                </form>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @foreach ($teams as $team)
                    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
                            <div>
                                <h3 class="font-bold text-gray-900">{{ $team->name }}</h3>
                                <span class="text-xs text-gray-500">{{ $team->age }}</span>
                            </div>
                            <form action="{{ route('admin.teams.destroy', $team->id) }}" method="POST" onsubmit="return confirm('Supprimer ?');">
                                @csrf @method('DELETE')
                                <button class="text-red-500 text-sm">Supprimer l'équipe</button>
                            </form>
                        </div>

                        <div class="p-4 border-b bg-blue-50/30">
                            <form action="{{ route('admin.teams.assign', $team->id) }}" method="POST" class="flex gap-2">
                                @csrf
                                <select name="user_id" required class="w-full text-sm border-gray-300 rounded-md">
                                    <option value="" disabled selected>-- Ajouter un joueur licencié --</option>
                                    @foreach($licensedPlayers as $player)
                                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="px-3 py-2 bg-blue-600 text-white rounded-md text-sm">Ajouter</button>
                            </form>
                        </div>

                        <ul class="divide-y divide-gray-100 max-h-64 overflow-y-auto">
                            @forelse($team->users as $user)
                                <li class="px-6 py-3 flex justify-between items-center">
                                    <span class="text-sm font-medium">{{ $user->name }}</span>
                                    <form action="{{ route('admin.teams.remove', [$team->id, $user->id]) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="text-xs text-red-500">Retirer</button>
                                    </form>
                                </li>
                            @empty
                                <li class="px-6 py-4 text-center text-sm text-gray-500">Aucun joueur.</li>
                            @endforelse
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
