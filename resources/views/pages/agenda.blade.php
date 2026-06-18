<x-app-layout>

    <div class="py-12 max-w-6xl mx-auto px-6">

        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-green-800 mb-3">
                Agenda du Club
            </h1>
            <p class="text-gray-600 max-w-xl mx-auto">
                Retrouvez ici les prochains rendez-vous de l'AFCLL : matchs, entraînements, tournois et événements festifs.
            </p>
        </div>

        <div class="space-y-6 max-w-4xl mx-auto">

            @forelse($events as $event)
                <div class="agenda-card">

                    {{-- BLOC DATE GAUCHE --}}
                    <div class="agenda-date-box {{ $event->type === 'Match' ? 'match-bg' : 'event-bg' }}">
                        <span class="day">{{ $event->date_heure->format('d') }}</span>
                        <span class="month">{{ $event->date_heure->translatedFormat('M') }}</span>
                    </div>

                    {{-- INFOS CENTRE --}}
                    <div class="agenda-info">
                        <div class="flex flex-wrap items-center gap-2 mb-1">
                            <span class="badge
                                {{ $event->type === 'Match' ? 'badge-match' : '' }}
                                {{ $event->type === 'Entraînement' ? 'badge-train' : '' }}
                                {{ $event->type === 'Tournoi' ? 'badge-tourney' : '' }}
                                {{ $event->type === 'Réunion' ? 'badge-meeting' : '' }}">
                                {{ $event->type }}
                            </span>
                            <span class="time">
                                🕒 {{ $event->date_heure->format('H\hi') }}
                            </span>
                        </div>

                        <h3 class="event-title">{{ $event->titre }}</h3>

                        @if($event->lieu)
                            <p class="event-location">📍 {{ $event->lieu }}</p>
                        @endif

                        @if($event->description)
                            <p class="event-desc">{{ $event->description }}</p>
                        @endif
                    </div>

                </div>
            @empty
                <div class="text-center py-12 bg-white rounded-2xl border border-gray-200 shadow-sm">
                    <p class="text-gray-500 text-lg">Aucun événement n'est programmé pour le moment. Repassez un peu plus tard !</p>
                </div>
            @endforelse

        </div>

    </div>

</x-app-layout>

<style>
    /* CARTES AGENDA */
    .agenda-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        display: flex;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        transition: 0.3s;
    }

    .agenda-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    /* BOITE DATE GAUCHE */
    .agenda-date-box {
        width: 100px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        flex-shrink: 0;
    }

    .match-bg { background: linear-gradient(135deg, #16a34a, #15803d); }
    .event-bg { background: linear-gradient(135deg, #2563eb, #1d4ed8); }

    .agenda-date-box .day { font-size: 32px; line-height: 1; }
    .agenda-date-box .month { font-size: 14px; text-uppercase: uppercase; opacity: 0.9; margin-top: 2px; }

    /* CONTENU INFO */
    .agenda-info {
        padding: 20px;
        flex-grow: 1;
    }

    .event-title { font-size: 20px; font-weight: 700; color: #111827; margin-bottom: 4px; }
    .event-location { font-size: 14px; color: #4b5563; font-medium; margin-bottom: 6px; }
    .event-desc { font-size: 14px; color: #6b7280; border-top: 1px solid #f3f4f6; pt: 8px; mt: 8px; }
    .time { font-size: 14px; color: #4b5563; font-weight: 500; }

    /* BADGES TYPOLOGIE */
    .badge {
        font-size: 11px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 9999px;
        text-transform: uppercase;
        background: #f3f4f6;
        color: #4b5563;
    }
    .badge-match { background: #dcfce7; color: #16a34a; }
    .badge-train { background: #dbeafe; color: #2563eb; }
    .badge-tourney { background: #fef9c3; color: #ca8a04; }
    .badge-meeting { background: #f3e8ff; color: #9333ea; }

    /* RESPONSIVE */
    @media (max-width: 640px) {
        .agenda-card { flex-direction: column; }
        .agenda-date-box { width: 100%; py: 15px; flex-direction: row; gap: 10px; }
        .agenda-date-box .day { font-size: 24px; }
    }
</style>
