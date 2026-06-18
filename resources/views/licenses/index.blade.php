<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">

            <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Mes Licences</h1>
                    <p class="mt-2 text-sm text-gray-600">Suivez l'état de vos demandes de licence pour la saison.</p>
                </div>

                <a href="{{ route('licenses.create') }}" class="inline-flex items-center justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Faire une demande
                </a>
            </div>

            @if (session('success'))
                <div class="mb-8 bg-green-50 border-l-4 border-green-500 p-4 rounded-md shadow-sm">
                    <div class="flex">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if($licenses->isEmpty())
                <div class="bg-white rounded-xl p-10 text-center border border-gray-200 shadow-sm">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900">Aucune demande de licence</h3>
                    <p class="mt-2 text-sm text-gray-500">Vous n'avez pas encore fait de demande pour cette saison.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($licenses as $license)
                        <div class="bg-white rounded-xl p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between border border-gray-200 shadow-sm hover:border-gray-300 transition duration-150">

                            <div class="flex-1 mb-4 sm:mb-0">
                                <div class="flex items-center gap-3 mb-1">
                                    <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wider">
                                        {{ $license->type_demande }}
                                    </h3>

                                    @if($license->status === 'validée')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                            Validée
                                        </span>
                                    @elseif($license->status === 'refusée')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                            Refusée
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                            En attente
                                        </span>
                                    @endif
                                </div>

                                <p class="text-sm text-gray-500">
                                    Demande effectuée le {{ $license->created_at->format('d/m/Y à H:i') }}
                                </p>
                            </div>

                            <div class="flex items-center gap-4">
                                <a href="{{ Storage::url($license->document_path) }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800 flex items-center transition duration-150">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Voir le document
                                </a>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
