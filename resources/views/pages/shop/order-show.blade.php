<x-app-layout>

    <div class="max-w-4xl mx-auto py-10 px-6">

        <h1 class="text-3xl font-bold mb-6">
            Commande #{{ $order->id }}
        </h1>

        <p class="mb-2">Client : {{ $order->user?->name }}</p>
        <p class="mb-2">Total : {{ $order->total_price }} €</p>
        <p class="mb-6">Statut : {{ $order->status }}</p>

        <hr class="my-6">

        @foreach($order->products as $product)

            <div class="mb-4 border-b pb-3">

                <p class="font-bold">{{ $product->name }}</p>

                <p>Quantité : {{ $product->pivot->quantity }}</p>

                @if($product->pivot->custom_name)
                    <p>
                        Flocage :
                        {{ $product->pivot->custom_name }}
                        #{{ $product->pivot->custom_number }}
                    </p>
                @endif

            </div>

        @endforeach

    </div>

</x-app-layout>
