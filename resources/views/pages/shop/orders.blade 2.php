<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Mes commandes
        </h2>
    </x-slot>

    <div class="p-8 max-w-5xl mx-auto space-y-6">

        @forelse($orders as $order)

            <div class="bg-white p-6 rounded-2xl shadow">

                {{-- HEADER --}}
                <div class="flex justify-between items-center mb-4">

                    <div>
                        <p class="font-bold">
                            Commande #{{ $order->id }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $order->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    <div class="text-right">

                        <p class="text-green-600 font-bold text-lg">
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
                <div class="border-t pt-4 space-y-2">

                    @foreach($order->products as $product)

                        <div class="flex justify-between text-sm">

                            <span>{{ $product->name }}</span>
                            <span>x{{ $product->pivot->quantity }}</span>

                        </div>

                        @if($product->pivot->custom_name)
                            <p class="text-xs text-blue-600">
                                Flocage :
                                {{ $product->pivot->custom_name }}
                                #{{ $product->pivot->custom_number }}
                            </p>
                        @endif

                    @endforeach

                </div>

                {{-- 🔥 BOUTON SUIVI --}}
                <div class="mt-4 text-right">
                    <a href="{{ route('orders.show', $order->id) }}"
                       class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        Suivre la commande
                    </a>
                </div>

            </div>

        @empty

            <div class="text-center text-gray-500">
                Aucune commande pour le moment
            </div>

        @endforelse

    </div>

</x-app-layout>
