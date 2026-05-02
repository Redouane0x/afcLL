<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Détail du produit
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10">

            <div class="bg-white p-6 rounded-2xl shadow">
                @if($product->image_url)
                    <img src="{{ asset('storage/' . $product->image_url) }}"
                         class="w-full h-96 object-cover rounded-xl">
                @endif
            </div>

            <div class="bg-white p-6 rounded-2xl shadow">

                <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>

                <p class="text-gray-500 mb-4 capitalize">
                    {{ $product->type }}
                </p>

                <p class="text-green-600 text-2xl font-bold mb-6">
                    {{ $product->price }} €
                </p>

                <form method="POST" action="{{ route('cart.add') }}">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="hidden" name="size" id="selectedSize">

                    {{-- ✅ QUANTITÉ --}}
                    <div class="mb-6">
                        <label class="block font-semibold mb-2">Quantité</label>

                        <input type="number"
                               name="quantity"
                               value="1"
                               min="1"
                               max="{{ $product->stock_quantity }}"
                               class="w-24 border rounded-lg p-2 text-center">
                    </div>

                    <button class="w-full bg-green-600 text-white py-3 rounded-xl hover:bg-green-700">
                        Ajouter au panier
                    </button>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
