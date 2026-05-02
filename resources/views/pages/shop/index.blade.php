<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Boutique officielle
        </h2>
    </x-slot>

    <div class="p-8 max-w-7xl mx-auto">

        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @forelse($products as $product)

                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">

                    {{-- IMAGE --}}
                    <div class="h-48 bg-gray-100">
                        @if($product->image_url)
                            <img src="{{ asset('storage/' . $product->image_url) }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400">
                                Pas d'image
                            </div>
                        @endif
                    </div>

                    {{-- CONTENU --}}
                    <div class="p-4">

                        <h3 class="font-semibold text-lg">
                            {{ $product->name }}
                        </h3>

                        <p class="text-green-600 font-bold text-xl">
                            {{ $product->price }} €
                        </p>

                        <a href="{{ route('shop.show', $product->id) }}"
                           class="mt-3 block text-center bg-green-600 text-white py-2 rounded hover:bg-green-700">
                            Voir produit
                        </a>

                    </div>

                </div>

            @empty

                <div class="col-span-4 text-center text-gray-500 py-10">
                    Aucun produit disponible
                </div>

            @endforelse

        </div>

    </div>

</x-app-layout>
