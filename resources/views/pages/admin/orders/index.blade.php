<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">
            📦 Commandes (Admin)
        </h2>
    </x-slot>

    <div class="p-8 max-w-6xl mx-auto">

        {{-- 🔥 ACTIONS --}}
        <div class="flex justify-between items-center mb-6">

            {{-- FILTRE + RECHERCHE --}}
            <form method="GET" class="bg-white p-4 rounded-xl shadow flex gap-4 flex-wrap">

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Rechercher utilisateur..."
                       class="border p-2 rounded w-60">

                <select name="status" class="border p-2 rounded">
                    <option value="">Tous les statuts</option>

                    <option value="en_attente" {{ request('status')=='en_attente' ? 'selected' : '' }}>
                        En attente
                    </option>

                    <option value="en_preparation" {{ request('status')=='en_preparation' ? 'selected' : '' }}>
                        En préparation
                    </option>

                    <option value="prete" {{ request('status')=='prete' ? 'selected' : '' }}>
                        Prête
                    </option>

                    <option value="livree" {{ request('status')=='livree' ? 'selected' : '' }}>
                        Livrée
                    </option>
                </select>

                <button class="bg-blue-600 text-white px-4 py-2 rounded">
                    Filtrer
                </button>

            </form>

            {{-- EXPORT --}}
            <a href="{{ route('admin.orders.export') }}"
               class="bg-gray-800 text-white px-4 py-2 rounded shadow">
                📥 Export CSV
            </a>

        </div>

        {{-- 📋 LISTE --}}
        <div class="space-y-6">

            @forelse($orders as $order)

                <div class="bg-white p-5 rounded-xl shadow">

                    {{-- HEADER --}}
                    <div class="flex justify-between items-center mb-3">

                        <div>
                            <p class="font-bold">
                                Commande #{{ $order->id }}
                            </p>

                            <p class="text-sm text-gray-500">
                                {{ $order->user?->name }}
                            </p>
                        </div>

                        <div class="flex items-center gap-3">

                            {{-- 🔥 BOUTON VOIR (AJOUT IMPORTANT) --}}
                            <a href="{{ route('admin.orders.show', $order->id) }}"
                               class="bg-blue-600 text-white px-3 py-1 rounded">
                                Voir
                            </a>

                            {{-- STATUT --}}
                            <span class="text-sm px-3 py-1 rounded
                            {{ $order->status == 'livree' ? 'bg-green-200 text-green-700' : '' }}
                            {{ $order->status == 'en_preparation' ? 'bg-yellow-200 text-yellow-700' : '' }}
                            {{ $order->status == 'prete' ? 'bg-blue-200 text-blue-700' : '' }}
                            {{ $order->status == 'en_attente' ? 'bg-gray-200 text-gray-700' : '' }}
                        ">
                            {{ $order->status }}
                        </span>

                        </div>

                    </div>

                    {{-- 💰 TOTAL --}}
                    <p class="mb-3 font-semibold">
                        Total : {{ $order->total_price }} €
                    </p>

                    {{-- 🔄 UPDATE STATUS --}}
                    <form method="POST"
                          action="{{ route('admin.orders.status', $order->id) }}"
                          class="flex gap-2 items-center">

                        @csrf

                        <select name="status" class="border p-2 rounded">

                            <option value="en_attente" {{ $order->status=='en_attente' ? 'selected' : '' }}>
                                En attente
                            </option>

                            <option value="en_preparation" {{ $order->status=='en_preparation' ? 'selected' : '' }}>
                                En préparation
                            </option>

                            <option value="prete" {{ $order->status=='prete' ? 'selected' : '' }}>
                                Prête
                            </option>

                            <option value="livree" {{ $order->status=='livree' ? 'selected' : '' }}>
                                Livrée
                            </option>

                        </select>

                        <button class="bg-green-600 text-white px-3 py-2 rounded">
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
