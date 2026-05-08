<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold">➕ Nouvelle actualité</h2>
    </x-slot>

    <div class="p-8 max-w-3xl mx-auto">

        <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
            @csrf

            <input name="title" placeholder="Titre" class="w-full border p-2 mb-3">

            <textarea name="content" placeholder="Contenu..." class="w-full border p-2 mb-3"></textarea>

            <input type="file" name="image" class="mb-3">

            <label class="block mb-2">
                <input type="checkbox" name="is_published"> Publier
            </label>

            <label class="block mb-3">
                <input type="checkbox" name="is_featured"> ⭐ Mettre en avant
            </label>

            <button class="bg-green-600 text-white px-4 py-2 rounded">
                Créer
            </button>

        </form>

    </div>

</x-app-layout>
