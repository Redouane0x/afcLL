<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            📦 Commandes (Admin)
        </h2>
    </x-slot>

    <div class="p-8 max-w-6xl mx-auto">

        {{-- 🔍 FILTRE --}}
        <form method="GET" class="bg-white p-4 rounded-xl shadow mb-6 flex gap-4 flex-wrap">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Rechercher utilisateur..."
                   class="border p-2 rounded w-60">

            <select name="status" class="border p-2 rounded">
                <option value="">Tous les statuts</option>
                <option value="en_attente">En attente</option>
                <option value="en_preparation">En préparation</option>
                <option value="prete">Prête</option>
                <option value="livree">Livrée</option>
            </select>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Filtrer
            </button>

        </form>

        {{-- 📋 LISTE --}}
        <div class="space-y-6">

            @forelse($orders as $order)

                <div class="bg-white p-5 rounded-xl shadow">

                    <div class="flex justify-between items-center mb-3">
                        <div>
                            <p class="font-bold">
                                Commande #{{ $order->id }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $order->user->name }}
                            </p>
                        </div>

                        <span class="text-sm bg-gray-200 px-3 py-1 rounded">
                            {{ $order->status }}
                        </span>
                    </div>

                    {{-- 💰 TOTAL --}}
                    <p class="mb-3 font-semibold">
                        Total : {{ $order->total_price }} €
                    </p>

                    {{-- 🔄 UPDATE STATUS --}}
                    <form method="POST"
                          action="{{ route('admin.orders.status', $order->id) }}"
                          class="flex gap-2">

                        @csrf

                        <select name="status" class="border p-2 rounded">
                            <option value="en_attente">En attente</option>
                            <option value="en_preparation">En préparation</option>
                            <option value="prete">Prête</option>
                            <option value="livree">Livrée</option>
                        </select>

                        <button class="bg-green-600 text-white px-3 rounded">
                            Modifier
                        </button>

                    </form>

                </div>

            @empty

                <div class="text-center text-gray-500">
                    Aucune commande trouvée
                </div>

            @endforelse

        </div>

    </div>

</x-app-layout>
