<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Détail du produit
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10">

            {{-- IMAGE --}}
            <div class="bg-white p-6 rounded-2xl shadow">
                @if($product->image_url)
                    <img src="{{ asset('storage/' . $product->image_url) }}"
                         class="w-full h-96 object-cover rounded-xl">
                @endif
            </div>

            {{-- INFOS --}}
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

                    {{-- 🔥 TAILLES --}}
                    @if($product->sizes_array)
                        <div class="mb-6">
                            <label class="block font-semibold mb-2">Choisir une taille</label>

                            <div class="flex gap-2 flex-wrap">
                                @foreach($product->sizes_array as $size)
                                    <button type="button"
                                            onclick="selectSize('{{ $size }}', this)"
                                            class="size-btn border px-4 py-2 rounded-lg hover:bg-gray-200">
                                        {{ $size }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- 🔥 FLOQUAGE --}}
                    @if($product->customizable)
                        <div class="mb-6">
                            <p class="font-semibold mb-2">Personnalisation</p>

                            <input name="custom_name"
                                   placeholder="Nom (optionnel)"
                                   class="w-full border p-2 rounded mb-2">

                            <input name="custom_number"
                                   placeholder="Numéro (optionnel)"
                                   class="w-full border p-2 rounded">
                        </div>
                    @endif

                    {{-- QUANTITÉ --}}
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

    {{-- SCRIPT TAILLES --}}
    <script>
        function selectSize(size, el) {
            document.getElementById('selectedSize').value = size;

            document.querySelectorAll('.size-btn').forEach(btn => {
                btn.classList.remove('bg-green-600', 'text-white');
            });

            el.classList.add('bg-green-600', 'text-white');
        }
    </script>

</x-app-layout>
