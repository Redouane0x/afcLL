<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-bold">Modifier produit</h2>
    </x-slot>

    <div class="p-6 max-w-xl mx-auto">

        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf

            <input name="name" value="{{ $product->name }}" class="border p-2 w-full mb-3">

            <input name="price" value="{{ $product->price }}" class="border p-2 w-full mb-3">

            <input name="stock_quantity" value="{{ $product->stock_quantity }}" class="border p-2 w-full mb-3">

            {{-- IMAGE --}}
            <input type="file" name="image" class="border p-2 w-full mb-3">

            @if($product->image_url)
                <img src="{{ asset('storage/' . $product->image_url) }}" class="w-32 mb-3 rounded">
            @endif

            <select name="type" class="border p-2 w-full mb-3">
                <option value="tshirt" @selected($product->type=='tshirt')>T-shirt</option>
                <option value="short" @selected($product->type=='short')>Short</option>
                <option value="manteau" @selected($product->type=='manteau')>Manteau</option>
                <option value="autre" @selected($product->type=='autre')>Autre</option>
            </select>

            {{-- TAILLES --}}
            <input name="sizes" value="{{ $product->sizes }}" class="border p-2 w-full mb-3">

            {{-- MATIÈRE --}}
            <input name="material" value="{{ $product->material }}" class="border p-2 w-full mb-3">

            {{-- DIMENSIONS --}}
            <input name="dimensions" value="{{ $product->dimensions }}" class="border p-2 w-full mb-3">

            <label class="flex items-center gap-2 mb-4">
                <input type="checkbox" name="customizable" value="1" {{ $product->customizable ? 'checked' : '' }}>
                Produit personnalisable
            </label>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Modifier
            </button>

        </form>

    </div>

</x-app-layout>
