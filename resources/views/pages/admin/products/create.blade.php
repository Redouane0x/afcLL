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

                <input name="name" placeholder="Nom" class="w-full border p-3 mb-4">

                <input type="number" step="0.01" name="price" placeholder="Prix"
                       class="w-full border p-3 mb-4">

                <input type="number" name="stock_quantity" placeholder="Stock"
                       class="w-full border p-3 mb-4">

                <input type="file" name="image"
                       class="w-full border p-3 mb-4">

                <select name="type" class="w-full border p-3 mb-4">
                    <option value="tshirt">T-shirt</option>
                    <option value="short">Short</option>
                    <option value="manteau">Manteau</option>
                    <option value="autre">Autre</option>
                </select>

                <button class="w-full bg-green-600 text-white py-3 rounded">
                    Ajouter le produit
                </button>

            </form>

        </div>
    </div>

</x-app-layout>
