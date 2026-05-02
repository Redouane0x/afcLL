<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Gestion des produits
        </h2>
    </x-slot>

    <div class="p-8 max-w-7xl mx-auto">

        {{-- HEADER ACTION --}}
        <div class="flex justify-between items-center mb-6">
            <p class="text-gray-600">
                Liste de tous les produits disponibles
            </p>

            <a href="{{ route('admin.products.create') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow">
                Ajouter un produit
            </a>
        </div>

        {{-- GRID PRODUITS --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($products as $product)

                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">

                    {{-- IMAGE --}}
                    <div class="h-48 bg-gray-100">
                        @if($product->image_url)
                            <img
                                src="{{ asset('storage/' . $product->image_url) }}"
                                class="w-full h-full object-cover"
                            >
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400">
                                Pas d'image
                            </div>
                        @endif
                    </div>

                    {{-- CONTENU --}}
                    <div class="p-4">

                        {{-- NOM --}}
                        <h3 class="font-semibold text-lg text-gray-800 mb-1">
                            {{ $product->name }}
                        </h3>

                        {{-- TYPE --}}
                        <p class="text-sm text-gray-500 capitalize mb-2">
                            {{ $product->type }}
                        </p>

                        {{-- PRIX --}}
                        <p class="text-green-600 font-bold text-xl mb-2">
                            {{ $product->price }} €
                        </p>

                        {{-- STOCK --}}
                        <p class="text-sm mb-3">
                            Stock :
                            <span class="{{ $product->stock_quantity > 0 ? 'text-green-600' : 'text-red-500' }}">
                                {{ $product->stock_quantity }}
                            </span>
                        </p>

                        {{-- BADGE PERSONNALISABLE --}}
                        @if($product->customizable)
                            <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded">
                                Personnalisable
                            </span>
                        @endif

                        {{-- ACTIONS --}}
                        <div class="flex justify-between items-center mt-4">

                            <a href="{{ route('admin.products.edit', $product->id) }}"
                               class="text-blue-600 hover:underline text-sm">
                                Modifier
                            </a>

                            <form method="POST" action="{{ route('admin.products.delete', $product->id) }}">
                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Supprimer ce produit ?')"
                                    class="text-red-500 hover:underline text-sm">
                                    Supprimer
                                </button>
                            </form>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-span-3 text-center text-gray-500 py-10">
                    Aucun produit disponible
                </div>

            @endforelse

        </div>

    </div>

</x-app-layout>
