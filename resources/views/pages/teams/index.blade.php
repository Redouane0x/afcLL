<x-app-layout>

    <div class="py-12 max-w-7xl mx-auto px-6">

        <h1 class="text-3xl font-bold mb-10 text-green-800">
            Nos équipes
        </h1>

        <div class="grid md:grid-cols-3 gap-6">

            @foreach($teams as $team)

                <a href="{{ route('teams.show', $team['slug']) }}"
                   class="team-card">

                    <div class="team-overlay"></div>

                    <div class="team-content">
                        <h2>{{ $team['name'] }}</h2>
                        <p>{{ $team['age'] }}</p>
                    </div>

                </a>

            @endforeach

        </div>

    </div>

</x-app-layout>

<style>
    .team-card {
        position: relative;
        background: url('https://via.placeholder.com/400x300') center/cover;
        height: 180px;
        border-radius: 16px;
        overflow: hidden;
        color: white;
        display: flex;
        align-items: flex-end;
        padding: 20px;
        transition: 0.3s;
    }

    .team-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
    }

    .team-content {
        position: relative;
        z-index: 2;
    }

    .team-card:hover {
        transform: translateY(-8px) scale(1.02);
    }
</style>
