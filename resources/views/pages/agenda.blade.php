<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-green-800 mb-6">Agenda des matchs</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 relative">
                <span class="absolute top-4 right-4 bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                    À venir
                </span>
                <h5 class="text-xl font-bold text-gray-800 mb-4">AFCLL vs Paris FC</h5>
                <p class="text-gray-600 mb-2"><strong>Date :</strong> 25 Avril 2026</p>
                <p class="text-gray-600"><strong>Lieu :</strong> Stade Municipal</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 relative opacity-80">
                <span class="absolute top-4 right-4 bg-gray-100 text-gray-600 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                    Terminé
                </span>
                <h5 class="text-xl font-bold text-gray-800 mb-4">AFCLL vs Lyon</h5>
                <p class="text-gray-600 mb-2"><strong>Date :</strong> 18 Avril 2026</p>
                <p class="text-gray-600"><strong>Score :</strong> 2 - 1</p>
            </div>

        </div>
    </div>
</x-app-layout>
