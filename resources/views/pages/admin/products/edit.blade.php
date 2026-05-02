<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-bold">Modifier produit</h2>
    </x-slot>

    <div class="p-6 max-w-xl mx-auto">

        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input name="name" value="{{ $product->name }}" class="border p-2 w-full mb-3">

            <input name="price" value="{{ $product->price }}" class="border p-2 w-full mb-3">

            <input name="stock_quantity" value="{{ $product->stock_quantity }}" class="border p-2 w-full mb-3">

            <input type="file" name="image" class="border p-2 w-full mb-3">

            @if($product->image_url)
                <img src="{{ asset('storage/' . $product->image_url) }}"
                     class="w-32 mb-3 rounded">
            @endif

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Modifier
            </button>

        </form>

    </div>

</x-app-layout>
