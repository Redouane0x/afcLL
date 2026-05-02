<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">Gestion Buvette</h2>
    </x-slot>

    <div class="p-6">

        <a href="{{ route('admin.buvette.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded">
            Ajouter produit
        </a>

        @foreach($products as $product)

            <div class="bg-white p-4 mt-4 rounded shadow flex justify-between items-center">

                <div>
                    @if($product->image_url)
                        <img src="{{ asset('storage/' . $product->image_url) }}"
                             class="w-20 h-20 object-cover mb-2 rounded">
                    @endif

                    <p class="font-bold">{{ $product->name }}</p>
                    <p>{{ $product->price }} €</p>
                    <p>Stock : {{ $product->stock_quantity }}</p>
                </div>

                <form method="POST" action="{{ route('admin.buvette.delete', $product->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500">Supprimer</button>
                </form>

            </div>

        @endforeach

    </div>

</x-app-layout>
