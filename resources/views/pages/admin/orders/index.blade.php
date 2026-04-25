<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Gestion des commandes
        </h2>
    </x-slot>

    <div class="p-8 max-w-6xl mx-auto space-y-6">

        @forelse($orders as $order)

            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">

                {{-- HEADER --}}
                <div class="flex justify-between items-center mb-4">

                    <div>
                        <p class="font-bold text-lg">
                            Commande #{{ $order->id }}
                        </p>

                        <p class="text-sm text-gray-500">
                            Client : {{ $order->user->name ?? 'N/A' }}
                        </p>

                        <p class="text-xs text-gray-400">
                            {{ $order->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    <div class="text-right">

                        <p class="font-bold text-green-600 text-lg">
                            {{ $order->total_price }} €
                        </p>

                        {{-- BADGE STATUS --}}
                        <span class="text-xs px-3 py-1 rounded-full font-semibold
                            @if($order->status == 'payee') bg-green-100 text-green-700
                            @elseif($order->status == 'en_preparation') bg-yellow-100 text-yellow-700
                            @elseif($order->status == 'expediee') bg-blue-100 text-blue-700
                            @elseif($order->status == 'livree') bg-gray-200 text-gray-700
                            @endif
                        ">
                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                        </span>

                    </div>

                </div>

                {{-- PRODUITS --}}
                <div class="border-t pt-4 space-y-3">

                    @foreach($order->products as $product)

                        <div class="flex justify-between items-center text-sm">

                            <div>
                                <p class="font-medium">{{ $product->name }}</p>

                                @if($product->pivot->custom_name)
                                    <p class="text-xs text-blue-600">
                                        Flocage : {{ $product->pivot->custom_name }}
                                        #{{ $product->pivot->custom_number }}
                                    </p>
                                @endif
                            </div>

                            <span class="text-gray-600">
                                x{{ $product->pivot->quantity }}
                            </span>

                        </div>

                    @endforeach

                </div>

                {{-- ACTION --}}
                <form method="POST"
                      action="{{ route('admin.orders.status', $order->id) }}"
                      class="mt-5 flex items-center gap-3">

                    @csrf

                    <select name="status"
                            class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500">

                        <option value="en_preparation"
                            {{ $order->status == 'en_preparation' ? 'selected' : '' }}>
                            En préparation
                        </option>

                        <option value="expediee"
                            {{ $order->status == 'expediee' ? 'selected' : '' }}>
                            Expédiée
                        </option>

                        <option value="livree"
                            {{ $order->status == 'livree' ? 'selected' : '' }}>
                            Livrée
                        </option>

                    </select>

                    <button
                        onclick="return confirm('Confirmer le changement de statut ?')"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                        Mettre à jour
                    </button>

                </form>

            </div>

        @empty

            <div class="text-center text-gray-500 py-10">
                Aucune commande trouvée
            </div>

        @endforelse

    </div>

</x-app-layout>
