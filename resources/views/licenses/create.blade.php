<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-xl mx-auto bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">

            <div class="px-8 py-10">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Demande de Licence AFCLL</h2>
                    <p class="mt-2 text-sm text-gray-600">Veuillez remplir le formulaire et joindre votre pièce d'identité pour la saison en cours.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                        <div class="flex">
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Des erreurs ont été trouvées :</h3>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('licenses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label for="type_demande" class="block text-sm font-medium text-gray-700">Type de demande</label>
                        <div class="mt-2">
                            <select id="type_demande" name="type_demande" required class="block w-full bg-white border border-gray-300 rounded-md py-3 px-4 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="" disabled selected>Sélectionnez une option...</option>
                                <option value="creation" {{ old('type_demande') == 'creation' ? 'selected' : '' }}>Nouvelle création (Nouveau joueur)</option>
                                <option value="renouvellement" {{ old('type_demande') == 'renouvellement' ? 'selected' : '' }}>Renouvellement (Déjà au club)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="document" class="block text-sm font-medium text-gray-700">Document d'identité (PDF, JPG, PNG)</label>
                        <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-blue-500 transition duration-150 ease-in-out group bg-gray-50">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-blue-500 transition duration-150 ease-in-out" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="document" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 px-2 py-1 border border-gray-200">
                                        <span>Télécharger un fichier</span>
                                        <input id="document" name="document" type="file" class="sr-only" accept=".pdf,.jpg,.jpeg,.png">
                                    </label>
                                    <p class="pl-1 py-1">ou glisser-déposer</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, PDF jusqu'à 4MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                            Envoyer ma demande
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-gray-50 px-8 py-4 border-t border-gray-200 text-center">
                <p class="text-xs text-gray-500">
                    Vos documents sont stockés de manière sécurisée et ne seront consultés que par l'administration du club.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
