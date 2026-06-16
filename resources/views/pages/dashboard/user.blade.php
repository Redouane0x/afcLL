<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mon Espace Supporter 📣
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Bonjour {{ auth()->user()->name }} !</h3>
                <p class="text-gray-600">Merci de soutenir l'AFCLL. Retrouvez ici tous vos accès rapides.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-blue-50 rounded-lg p-6 text-center shadow-sm">
                    <div class="text-4xl mb-3">📰</div>
                    <h4 class="font-bold text-gray-800 mb-2">Vie du club</h4>
                    <p class="text-sm text-gray-600 mb-4">Ne ratez aucun résultat ni événement de l'AFCLL.</p>
                    <a href="{{ route('news.index') }}" class="text-blue-600 font-bold hover:underline">Voir les actus</a>
                </div>

                <div class="bg-yellow-50 rounded-lg p-6 text-center shadow-sm">
                    <div class="text-4xl mb-3">🛍️</div>
                    <h4 class="font-bold text-gray-800 mb-2">Boutique</h4>
                    <p class="text-sm text-gray-600 mb-4">Équipez-vous aux couleurs du club pour les prochains matchs.</p>
                    <a href="{{ route('shop.index') }}" class="text-yellow-700 font-bold hover:underline">Visiter la boutique</a>
                </div>

                <div class="bg-gray-50 rounded-lg p-6 text-center shadow-sm border border-gray-200">
                    <div class="text-4xl mb-3">📦</div>
                    <h4 class="font-bold text-gray-800 mb-2">Mes Achats</h4>
                    <p class="text-sm text-gray-600 mb-4">Suivez l'état de vos commandes passées sur le site.</p>
                    <a href="{{ route('orders.index') }}" class="text-gray-600 font-bold hover:underline">Mes commandes</a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
