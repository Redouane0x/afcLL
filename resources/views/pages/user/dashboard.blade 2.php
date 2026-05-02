<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Dashboard
        </h2>
    </x-slot>

    <div class="p-6">
        <p>Bienvenue dans ton espace</p>

        <a href="{{ route('shop.index') }}">Aller à la boutique</a>
    </div>

</x-app-layout>
