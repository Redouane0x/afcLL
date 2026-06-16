<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Vestiaire AFCLL ⚽
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-gradient-to-r from-green-500 to-green-700 rounded-lg shadow-lg p-6 mb-6 text-white">
                <h3 class="text-2xl font-bold mb-2">Bienvenue sur le terrain, {{ auth()->user()->name }} !</h3>
                <p class="text-green-100">Ta licence est validée pour cette saison. Prêt pour le prochain match ?</p>
                @if(auth()->user()->number)
                    <div class="mt-4 inline-block bg-white text-green-800 font-bold px-4 py-2 rounded-full shadow">
                        Maillot N° {{ auth()->user()->number }}
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h4 class="text-lg font-bold text-gray-800 mb-2">🛍️ Équipements</h4>
                    <p class="text-gray-600 mb-4">Besoin de chaussettes ou d'un nouveau survêtement ?</p>
                    <a href="{{ route('shop.index') }}" class="inline-block bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">Aller à la boutique</a>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h4 class="text-lg font-bold text-gray-800 mb-2">📦 Mes commandes</h4>
                    <p class="text-gray-600 mb-4">Suis l'état de tes commandes à la boutique du club.</p>
                    <a href="{{ route('orders.index') }}" class="inline-block border border-gray-800 text-gray-800 px-4 py-2 rounded hover:bg-gray-100">Voir mes commandes</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
