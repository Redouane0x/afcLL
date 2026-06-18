<x-app-layout>

    <div class="player-page">

        {{-- HEADER --}}
        <div class="player-header">

            <div class="player-left">

                {{-- PHOTO 3D --}}
                <div class="player-photo-container">
                    <div class="player-photo-inner">

                        <div class="player-photo front" style="background: url('https://ui-avatars.com/api/?name={{ urlencode($player->name) }}&background=16a34a&color=fff&size=120') center/cover;"></div>

                        <div class="player-photo back">
                            <span>#{{ $player->id }}</span>
                        </div>

                    </div>
                </div>

                <div class="player-main">
                    <h1>{{ $player->name }}</h1>
                    <p class="position">{{ $player->position }}</p>

                    <div class="rating">
                        ⭐ <span>{{ $player->rating }}</span>
                    </div>
                </div>

            </div>

            <div class="player-right">
                <p>#{{ $player->id }}</p>
                <p>
                    @if($player->teams->isNotEmpty())
                        {{ $player->teams->first()->name }}
                    @else
                        AFCLL
                    @endif
                </p>
            </div>

        </div>

        {{-- STATS --}}
        <div class="stats-grid">

            <div class="stat">
                ⚽ <span>{{ $player->buts }}</span>
                <p>Buts</p>
            </div>

            <div class="stat">
                🎯 <span>{{ $player->passes }}</span>
                <p>Passes</p>
            </div>

            <div class="stat">
                🏆 <span>{{ $player->matchs_gagnes }}</span>
                <p>Matchs gagnés</p>
            </div>

        </div>

        {{-- DETAILS --}}
        <div class="player-details">

            <div class="detail">
                <span>{{ $player->matchs_joues }}</span>
                <p>Matchs</p>
            </div>

            <div class="detail">
                <span>{{ $player->reussite_passes }}%</span>
                <p>Réussite</p>
            </div>

            <div class="detail">
                <span>{{ $player->pied_fort }}</span>
                <p>Pied fort</p>
            </div>

            <div class="detail">
                <span>{{ $player->taille }}</span>
                <p>Taille</p>
            </div>

        </div>

    </div>

</x-app-layout>

<style>

    :root {
        --primary: #16a34a;
        --primary-dark: #15803d;

        --bg-main: #f3f4f6;     /* fond clair */
        --bg-card: #ffffff;     /* cartes */
        --bg-soft: #f9fafb;

        --text-main: #111827;
        --text-muted: #6b7280;
    }

    /* PAGE */
    .player-page {
        max-width: 900px;
        margin: auto;
        padding: 40px 20px;
        color: var(--text-main);
    }

    /* HEADER */
    .player-header {
        display: flex;
        justify-content: space-between;
        align-items: center;

        background: linear-gradient(135deg, #ffffff, #f3f4f6);
        border: 1px solid #e5e7eb;

        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
    }

    /* LEFT */
    .player-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    /* PHOTO */
    .player-photo-container {
        perspective: 1000px;
    }

    .player-photo-inner {
        width: 120px;
        height: 120px;
        position: relative;
        transform-style: preserve-3d;
        transition: transform 0.8s;
    }

    .player-photo-container:hover .player-photo-inner {
        transform: rotateY(180deg);
    }

    .player-photo {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        backface-visibility: hidden;
    }

    /* AVANT */
    .player-photo.front {
        border: 3px solid var(--primary);
        box-shadow: 0 0 8px rgba(22,163,74,0.2);
    }

    /* ARRIÈRE */
    .player-photo.back {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        transform: rotateY(180deg);
    }

    /* TEXT */
    .player-main h1 {
        font-size: 32px;
        font-weight: bold;
    }

    .position {
        color: var(--text-muted);
    }

    .rating span {
        font-size: 42px;
        font-weight: bold;
        color: var(--primary);
    }

    /* RIGHT */
    .player-right {
        text-align: right;
        font-size: 20px;
        color: var(--text-muted);
    }

    /* STATS */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 30px;
    }

    .stat {
        background: var(--bg-card);
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        border: 1px solid #e5e7eb;
    }

    .stat span {
        font-size: 26px;
        font-weight: bold;
        color: var(--primary);
    }

    /* DETAILS */
    .player-details {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
    }

    .detail {
        background: var(--bg-card);
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        border: 1px solid #e5e7eb;
    }

    .detail span {
        font-weight: bold;
        font-size: 20px;
        color: var(--primary);
    }

    /* HOVER */
    .stat:hover,
    .detail:hover {
        transform: translateY(-5px);
        background: var(--bg-soft);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {

        .player-header {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .player-left {
            flex-direction: column;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .player-details {
            grid-template-columns: repeat(2, 1fr);
        }
    }

</style>
