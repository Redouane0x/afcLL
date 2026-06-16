<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            💻 Espace Administration AFCLL
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Bonjour, {{ auth()->user()->name }} 👋</h3>
                <p class="text-gray-600">Voici un résumé de l'activité du club aujourd'hui.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Membres Inscrits</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['total_users'] }}</div>
                </div>

                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Joueurs Licenciés</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['joueurs_licencies'] }}</div>
                </div>

                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Commandes Boutique</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['commandes_attente'] }}</div>
                    <div class="text-xs text-red-500 mt-1">À préparer</div>
                </div>

                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
                    <div class="text-sm font-medium text-gray-500 uppercase">Licences en attente</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['licences_attente'] }}</div>
                    <div class="text-xs text-red-500 mt-1">À valider</div>
                </div>

            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">⚡ Actions Rapides</h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('admin.users.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">Gérer les utilisateurs</a>
                    <a href="{{ route('admin.orders') }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Voir les commandes</a>
                    <a href="{{ route('admin.produits.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ajouter un produit</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
