<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Boutique officielle
        </h2>
    </x-slot>

    <div class="p-8 max-w-7xl mx-auto">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

            @foreach($products as $product)

                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition duration-300 overflow-hidden">

                    {{-- IMAGE --}}
                    @if($product->image_url)
                        <div class="h-48 bg-gray-100 relative">

                            <img
                                src="{{ asset('storage/' . $product->image_url) }}"
                                class="w-full h-full object-cover"
                            >

                            {{-- BADGE PERSONNALISABLE --}}
                            @if($product->customizable)
                                <span class="absolute top-2 left-2 text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded">
                                    Personnalisable
                                </span>
                            @endif

                        </div>
                    @endif

                    <div class="p-4">

                        {{-- NOM --}}
                        <h3 class="font-semibold text-lg text-gray-800 mb-1">
                            {{ $product->name }}
                        </h3>

                        {{-- TYPE --}}
                        <p class="text-sm text-gray-500 mb-2 capitalize">
                            {{ $product->type }}
                        </p>

                        {{-- PRIX --}}
                        <p class="text-green-600 font-bold text-xl mb-3">
                            {{ $product->price }} €
                        </p>

                        {{-- BOUTON --}}
                        <a
                            href="{{ route('shop.show', $product->id) }}"
                            class="block text-center bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition"
                        >
                            Voir le produit
                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</x-app-layout>
