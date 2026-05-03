<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">Actualités</h2>
    </x-slot>

    <div class="p-8 max-w-5xl mx-auto space-y-6">

        @foreach($news as $item)

            <div class="bg-white p-5 rounded-xl shadow">

                @if($item->image)
                    <img src="{{ asset('storage/'.$item->image) }}" class="mb-3 rounded">
                @endif

                <h3 class="text-xl font-bold">{{ $item->title }}</h3>

                <p class="text-gray-600 mt-2">
                    {{ $item->content }}
                </p>

            </div>

        @endforeach

    </div>

</x-app-layout>
