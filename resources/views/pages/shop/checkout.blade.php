<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Paiement
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">

            <h3 class="text-xl font-bold mb-4">Récapitulatif</h3>

            @foreach($cart as $item)
                <div class="flex justify-between mb-2">
                    <span>{{ $item['name'] }}</span>
                    <span>{{ $item['price'] }} €</span>
                </div>
            @endforeach

            <hr class="my-4">

            <p class="text-right font-bold text-xl">
                Total : {{ collect($cart)->sum('price') }} €
            </p>

            <form method="POST" action="{{ route('checkout.process') }}">
                @csrf

                <button class="mt-6 w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700">
                    Payer
                </button>
            </form>

        </div>
    </div>

</x-app-layout>404


