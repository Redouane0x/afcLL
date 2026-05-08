<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Boutique officielle
        </h2>
    </x-slot>

    <div class="p-8 max-w-7xl mx-auto">

        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

            @forelse($products as $product)

                {{-- 🔥 CARTE CLIQUABLE --}}
                <a href="{{ route('shop.show', $product->id) }}"
                   class="block group">

                    <div class="relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden">

                        {{-- IMAGE --}}
                        <div class="h-52 bg-gray-100 overflow-hidden relative">

                            @if($product->image_url)
                                <img src="{{ asset('storage/' . $product->image_url) }}"
                                     class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400">
                                    Pas d'image
                                </div>
                            @endif

                            {{-- 🔥 OVERLAY FIX (ne bloque plus les clics) --}}
                            <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition pointer-events-none"></div>

                            {{-- BADGES --}}
                            @if($product->stock_quantity <= 0)
                                <span class="absolute top-2 left-2 bg-red-600 text-white text-xs px-2 py-1 rounded-full">
                                    Rupture
                                </span>
                            @elseif($product->stock_quantity < 5)
                                <span class="absolute top-2 left-2 bg-orange-500 text-white text-xs px-2 py-1 rounded-full">
                                    Stock faible
                                </span>
                            @endif

                        </div>

                        {{-- CONTENU --}}
                        <div class="p-4">

                            <h3 class="font-semibold text-lg group-hover:text-green-700 transition">
                                {{ $product->name }}
                            </h3>

                            <p class="text-gray-500 text-sm capitalize">
                                {{ $product->type }}
                            </p>

                            <p class="text-green-600 font-bold text-xl mt-2">
                                {{ $product->price }} €
                            </p>

                        </div>

                    </div>

                </a>

            @empty

                <div class="col-span-4 text-center text-gray-500 py-10">
                    Aucun produit disponible
                </div>

            @endforelse

        </div>

    </div>

</x-app-layout>
