<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-green-800">Agenda officiel de l'AFCLL</h1>
            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                {{ $matchs->count() }} Matchs synchronisés
            </span>
        </div>

        <div class="bg-white shadow-sm border border-gray-100 rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Compétition</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Match</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Score</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($matchs as $match)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $match->date }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-xs font-bold">
                                {{ $match->competition }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            <div class="flex items-center space-x-2">
                                <span class="{{ str_contains($match->equipe_domicile, 'Liebaut') ? 'font-bold text-green-700' : '' }}">
                                    {{ $match->equipe_domicile }}
                                </span>
                                <span class="text-gray-400 text-xs">VS</span>
                                <span class="{{ str_contains($match->equipe_exterieur, 'Liebaut') ? 'font-bold text-green-700' : '' }}">
                                    {{ $match->equipe_exterieur }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($match->score && $match->score !== '-')
                                <span class="bg-gray-800 text-white px-3 py-1 rounded font-mono text-sm">
                                    {{ $match->score }}
                                </span>
                            @else
                                <span class="text-gray-400 text-xs italic">À venir</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4 text-center">
            <p class="text-gray-500 text-xs italic">Données synchronisées depuis Footclubs via votre robot.</p>
        </div>

    </div>
</x-app-layout>
