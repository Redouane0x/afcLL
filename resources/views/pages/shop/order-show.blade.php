<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Détail de la commande
        </h2>
    </x-slot>

    <div class="p-8 max-w-4xl mx-auto">

        <div class="bg-white p-6 rounded-2xl shadow">

            {{-- HEADER --}}
            <div class="flex justify-between mb-6">

                <div>
                    <p class="font-bold text-lg">
                        Commande #{{ $order->id }}
                    </p>

                    <p class="text-sm text-gray-500">
                        {{ $order->created_at->format('d/m/Y H:i') }}
                    </p>
                </div>

                <div class="text-right">

                    <p class="text-green-600 font-bold text-xl">
                        {{ $order->total_price }} €
                    </p>

                    <span class="text-xs px-3 py-1 rounded-full
                        @if($order->status == 'payee') bg-green-100 text-green-700
                        @elseif($order->status == 'en_preparation') bg-yellow-100 text-yellow-700
                        @elseif($order->status == 'expediee') bg-blue-100 text-blue-700
                        @elseif($order->status == 'livree') bg-gray-200 text-gray-700
                        @endif
                    ">
                        {{ ucfirst(str_replace('_',' ', $order->status)) }}
                    </span>

                </div>

            </div>

            {{-- PRODUITS --}}
            <div class="border-t pt-4 space-y-4">

                @foreach($order->products as $product)

                    <div class="flex justify-between items-center">

                        <div>
                            <p class="font-semibold">{{ $product->name }}</p>

                            <p class="text-sm text-gray-500">
                                Quantité : {{ $product->pivot->quantity }}
                            </p>

                            @if($product->pivot->custom_name)
                                <p class="text-xs text-blue-600">
                                    Flocage :
                                    {{ $product->pivot->custom_name }}
                                    #{{ $product->pivot->custom_number }}
                                </p>
                            @endif
                        </div>

                    </div>

                @endforeach

            </div>

            {{-- RETOUR --}}
            <div class="mt-6">
                <a href="{{ route('orders.index') }}"
                   class="text-green-600 hover:underline">
                    ← Retour aux commandes
                </a>
            </div>

        </div>

    </div>

</x-app-layout>
