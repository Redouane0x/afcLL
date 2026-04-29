<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Ajouter un produit
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-8">

            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- NOM --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Nom du produit
                    </label>
                    <input name="name" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-green-500 outline-none">
                </div>

                {{-- PRIX + STOCK --}}
                <div class="grid grid-cols-2 gap-4 mb-5">

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Prix (€)</label>
                        <input type="number" step="0.01" name="price" class="w-full border rounded-lg p-3 mt-1">
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Stock</label>
                        <input type="number" name="stock_quantity" class="w-full border rounded-lg p-3 mt-1">
                    </div>

                </div>

                {{-- IMAGE --}}
                <div class="mb-5">
                    <label class="text-sm font-semibold text-gray-700">Image</label>
                    <input type="file" name="image" class="w-full border rounded-lg p-3 mt-1 bg-gray-50">
                </div>

                {{-- TYPE --}}
                <div class="mb-5">
                    <label class="text-sm font-semibold text-gray-700">Type</label>
                    <select name="type" class="w-full border rounded-lg p-3 mt-1">
                        <option value="">-- Choisir --</option>
                        <option value="tshirt">T-shirt</option>
                        <option value="short">Short</option>
                        <option value="manteau">Manteau</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>

                {{-- TAILLES --}}
                <div class="mb-5">
                    <label class="text-sm font-semibold text-gray-700">Tailles</label>
                    <input name="sizes" placeholder="S, M, L, XL" class="w-full border rounded-lg p-3 mt-1">
                </div>

                {{-- MATIÈRE --}}
                <div class="mb-5">
                    <label class="text-sm font-semibold text-gray-700">Matière</label>
                    <input name="material" placeholder="Coton, polyester..." class="w-full border rounded-lg p-3 mt-1">
                </div>

                {{-- DIMENSIONS --}}
                <div class="mb-5">
                    <label class="text-sm font-semibold text-gray-700">Dimensions</label>
                    <input name="dimensions" placeholder="Ex: 70x50 cm" class="w-full border rounded-lg p-3 mt-1">
                </div>

                {{-- PERSONNALISABLE --}}
                <div class="mb-6 flex items-center gap-2">
                    <input type="checkbox" name="customizable" value="1" class="w-4 h-4">
                    <label class="text-sm text-gray-700">
                        Produit personnalisable
                    </label>
                </div>

                {{-- BOUTON --}}
                <button class="w-full bg-green-600 text-white py-3 rounded-xl font-semibold hover:bg-green-700 transition">
                    Ajouter le produit
                </button>

            </form>

        </div>
    </div>

</x-app-layout>
