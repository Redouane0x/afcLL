<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Gestion des Licences</h1>
                    <p class="mt-2 text-sm text-gray-600">Validez ou refusez les demandes de licences des joueurs.</p>
                </div>

                <div class="flex bg-white rounded-lg p-1 border border-gray-200 shadow-sm">
                    <a href="{{ route('admin.licenses.index') }}" class="px-4 py-2 text-sm font-medium rounded-md transition-colors {{ request('status') === null ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        Toutes
                    </a>
                    <a href="{{ route('admin.licenses.index', ['status' => 'en attente']) }}" class="px-4 py-2 text-sm font-medium rounded-md transition-colors {{ request('status') === 'en attente' ? 'bg-yellow-100 text-yellow-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        En attente
                    </a>
                    <a href="{{ route('admin.licenses.index', ['status' => 'validée']) }}" class="px-4 py-2 text-sm font-medium rounded-md transition-colors {{ request('status') === 'validée' ? 'bg-green-100 text-green-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        Validées
                    </a>
                    <a href="{{ route('admin.licenses.index', ['status' => 'refusée']) }}" class="px-4 py-2 text-sm font-medium rounded-md transition-colors {{ request('status') === 'refusée' ? 'bg-red-100 text-red-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        Refusées
                    </a>
                </div>
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

            <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joueur</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Document</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($licenses as $license)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-700 font-bold">
                                            {{ strtoupper(substr($license->user->name ?? '?', 0, 1)) }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $license->user->name ?? 'Utilisateur supprimé' }}</div>
                                            <div class="text-sm text-gray-500">{{ $license->user->email ?? '' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-700 capitalize">{{ $license->type_demande }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $license->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ Storage::url($license->document_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800 flex items-center gap-1 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Voir
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
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
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    @if($license->status === 'en attente')
                                        <div class="flex justify-end gap-2">
                                            <form action="{{ route('admin.licenses.status', $license->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <input type="hidden" name="status" value="validée">
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                                    Valider
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.licenses.status', $license->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir refuser cette licence ?');">
                                                @csrf
                                                <input type="hidden" name="status" value="refusée">
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                                    Refuser
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-gray-500 italic text-xs">Traitée</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Aucune demande de licence trouvée avec ce statut.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                @if($licenses->hasPages())
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        {{ $licenses->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
