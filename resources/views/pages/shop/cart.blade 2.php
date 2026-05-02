<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Mon panier
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto space-y-4">

            @forelse($cart as $index => $item)

                <div class="bg-white p-5 rounded-xl shadow flex justify-between items-center">

                    <div>
                        <h3 class="font-bold text-lg">{{ $item['name'] }}</h3>
                        <p class="text-gray-600">{{ $item['price'] }} €</p>

                        @if($item['size'])
                            <p class="text-sm text-gray-500">Taille : {{ $item['size'] }}</p>
                        @endif

                        @if($item['custom_name'])
                            <p class="text-sm text-blue-600">
                                Flocage : {{ $item['custom_name'] }} #{{ $item['custom_number'] }}
                            </p>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('cart.remove', $index) }}">
                        @csrf
                        <button class="text-red-500 hover:underline">
                            Supprimer
                        </button>
                    </form>

                </div>

            @empty

                <div class="text-center text-gray-500">
                    Panier vide
                </div>

            @endforelse

            {{-- TOTAL --}}
            @if(count($cart) > 0)
                <div class="bg-white p-5 rounded-xl shadow text-right">

                    <p class="text-xl font-bold">
                        Total : {{ collect($cart)->sum('price') }} €
                    </p>

                    {{-- ✅ BON BOUTON --}}
                    <form method="GET" action="{{ route('checkout') }}">
                        <button class="mt-4 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">
                            Passer commande
                        </button>
                    </form>

                </div>
            @endif

        </div>
    </div>

</x-app-layout>
