<x-app-layout>

    <div class="player-page">

        {{-- HEADER --}}
        <div class="player-header">

            <div class="player-left">

                {{-- PHOTO --}}
                <div class="player-photo-container">
                    <div class="player-photo-inner">

                        <div class="player-photo front"></div>

                        <div class="player-photo back">
                            <span>#{{ $id }}</span>
                        </div>

                    </div>
                </div>

                <div class="player-main">
                    <h1>Coach {{ $id }}</h1>
                    <p class="position">Entraîneur</p>

                    <div class="rating">
                        ⭐ <span>90</span>
                    </div>
                </div>

            </div>

            <div class="player-right">
                <p>#{{ $id }}</p>
                <p>AFC Liébaut</p>
            </div>

        </div>

        {{-- STATS --}}
        <div class="stats-grid">

            <div class="stat">
                🏆 <span>15</span>
                <p>Matchs gagnés</p>
            </div>

            <div class="stat">
                📊 <span>80%</span>
                <p>Réussite</p>
            </div>

            <div class="stat">
                ⚽ <span>120</span>
                <p>Buts coachés</p>
            </div>

        </div>

        {{-- DETAILS --}}
        <div class="player-details">

            <div class="detail">
                <span>10</span>
                <p>Années exp</p>
            </div>

            <div class="detail">
                <span>UEFA B</span>
                <p>Diplôme</p>
            </div>

            <div class="detail">
                <span>4-3-3</span>
                <p>Formation</p>
            </div>

            <div class="detail">
                <span>France</span>
                <p>Nationalité</p>
            </div>

        </div>

    </div>

</x-app-layout>

<style>

    /* même style que joueur (harmonisé) */

    .player-page {
        max-width: 900px;
        margin: auto;
        padding: 40px 20px;
        color: #1f2937;
    }

    .player-header {
        display: flex;
        justify-content: space-between;
        align-items: center;

        background: #ffffff;
        border: 1px solid #e5e7eb;

        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
    }

    .player-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

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

    .player-photo.front {
        background: url('https://via.placeholder.com/120') center/cover;
        border: 3px solid #16a34a;
    }

    .player-photo.back {
        background: linear-gradient(135deg, #16a34a, #166534);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        transform: rotateY(180deg);
    }

    .player-main h1 {
        font-size: 32px;
        font-weight: bold;
    }

    .position {
        color: #6b7280;
    }

    .rating span {
        font-size: 42px;
        font-weight: bold;
        color: #16a34a;
    }

    .player-right {
        text-align: right;
        font-size: 20px;
        color: #6b7280;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 30px;
    }

    .stat {
        background: #ffffff;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        border: 1px solid #e5e7eb;
    }

    .stat span {
        font-size: 26px;
        font-weight: bold;
        color: #16a34a;
    }

    .player-details {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
    }

    .detail {
        background: #ffffff;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        border: 1px solid #e5e7eb;
    }

    .detail span {
        font-weight: bold;
        font-size: 20px;
        color: #16a34a;
    }

    .stat:hover,
    .detail:hover {
        transform: translateY(-6px);
        background: #f9fafb;
    }

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
