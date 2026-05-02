<x-app-layout>

    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-800">
            🥤 Buvette du club
        </h2>
    </x-slot>

    <div class="p-8 max-w-7xl mx-auto">

        {{-- INTRO --}}
        <div class="mb-8 text-center">
            <p class="text-gray-600 text-lg">
                Retrouvez tous les produits disponibles à la buvette lors des matchs ⚽
            </p>
        </div>

        {{-- GRID --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach($products as $product)

                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">

                    {{-- IMAGE --}}
                    @if($product->image_url)
                        <img src="{{ asset('storage/' . $product->image_url) }}"
                             class="w-full h-40 object-cover">
                    @else
                        <div class="h-40 bg-gray-100 flex items-center justify-center text-gray-400">
                            Pas d’image
                        </div>
                    @endif

                    {{-- INFOS --}}
                    <div class="p-4 text-center">

                        <h3 class="font-bold text-lg mb-1">
                            {{ $product->name }}
                        </h3>

                        <p class="text-green-600 font-bold text-xl mb-2">
                            {{ $product->price }} €
                        </p>

                        {{-- STOCK --}}
                        @if($product->stock_quantity > 0)
                            <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                Disponible
                            </span>
                        @else
                            <span class="text-xs bg-red-100 text-red-600 px-3 py-1 rounded-full">
                                Rupture
                            </span>
                        @endif

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</x-app-layout>
