<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">Ajouter produit (Buvette)</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

            <form method="POST" action="{{ route('admin.buvette.store') }}" enctype="multipart/form-data">
                @csrf

                <input type="text" name="name" placeholder="Nom" class="w-full border p-2 mb-3 rounded" required>

                <input type="number" step="0.01" name="price" placeholder="Prix" class="w-full border p-2 mb-3 rounded" required>

                <input type="number" name="stock_quantity" placeholder="Stock" class="w-full border p-2 mb-3 rounded" required>

                <input type="file" name="image" class="w-full mb-4">

                <button class="w-full bg-green-600 text-white py-3 rounded">
                    Ajouter
                </button>

            </form>

        </div>
    </div>

</x-app-layout>
