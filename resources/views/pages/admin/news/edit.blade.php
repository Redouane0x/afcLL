<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">✏️ Modifier actualité</h2>
    </x-slot>

    <div class="p-8 max-w-3xl mx-auto">

        <form method="POST" action="{{ route('admin.news.update', $news->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input name="title" value="{{ $news->title }}" class="w-full border p-2 mb-3">

            <textarea name="content" class="w-full border p-2 mb-3">{{ $news->content }}</textarea>

            @if($news->image)
                <img src="{{ asset('storage/'.$news->image) }}" class="mb-3 rounded">
            @endif

            <input type="file" name="image" class="mb-3">

            <label>
                <input type="checkbox" name="is_published" @checked($news->is_published)>
                Publier
            </label>

            <label class="block mb-3">
                <input type="checkbox" name="is_featured" @checked($news->is_featured)>
                ⭐ Mettre en avant
            </label>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Modifier
            </button>

        </form>

    </div>

</x-app-layout>
