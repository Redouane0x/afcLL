<x-app-layout>
    <div class="py-12 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-green-800 mb-6">Contact</h1>

        <form class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nom</label>
                <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Message</label>
                <textarea class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500" rows="5"></textarea>
            </div>

            <button type="submit" class="bg-green-800 text-white px-6 py-2 rounded font-bold hover:bg-green-700 transition">
                Envoyer
            </button>
        </form>
    </div>
</x-app-layout>
