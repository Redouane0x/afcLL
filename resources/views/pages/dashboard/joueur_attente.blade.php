<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Espace Joueur (En attente) ⏳
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-red-50 border-l-4 border-red-500 p-6 shadow-sm sm:rounded-lg mb-6">
                <div class="flex items-center mb-2">
                    <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <h3 class="text-lg font-bold text-red-800">Action requise pour ta licence</h3>
                </div>
                <p class="text-red-700 mb-4">
                    Bonjour {{ auth()->user()->name }}, ton profil est actuellement en attente. Pour pouvoir participer aux matchs et accéder au vestiaire numérique, tu dois finaliser ta demande de licence.
                </p>
                <a href="{{ route('licenses.index') }}" class="inline-block bg-red-600 text-white font-bold px-6 py-2 rounded shadow hover:bg-red-700 transition">
                    Régulariser ma licence
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h4 class="text-lg font-bold text-gray-800 mb-2">En attendant...</h4>
                <p class="text-gray-600">Tu peux tout de même suivre l'actualité du club ou commander sur la boutique.</p>
                <div class="mt-4 flex gap-4">
                    <a href="{{ route('news.index') }}" class="text-blue-600 hover:underline">Lire les actualités &rarr;</a>
                    <a href="{{ route('shop.index') }}" class="text-blue-600 hover:underline">Voir la boutique &rarr;</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
