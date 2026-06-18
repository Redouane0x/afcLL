<nav x-data="{ open: false, submenu: null }"
     @keydown.escape.window="open = false; submenu = null"
     class="bg-green-700 shadow-md sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between h-16">

            {{-- LEFT --}}
            <div class="flex items-center gap-4">
                <button @click="open = true" class="text-white text-xl">☰</button>

                <a href="/" class="flex items-center gap-2 text-white font-bold text-lg">
                    <img src="/images/logo.png" class="w-9 h-9 rounded"
                         onerror="this.src='https://via.placeholder.com/40'">
                    AFCLL
                </a>
            </div>

            {{-- CENTER --}}
            <div class="hidden lg:flex items-center gap-6">
                <a href="/" class="nav-link">Accueil</a>
                <a href="/boutique" class="nav-link">Boutique</a>
                <a href="{{ route('buvette') }}" class="nav-link">Buvette</a>
            </div>

            {{-- RIGHT --}}
            <div class="hidden lg:flex items-center gap-3">

                {{-- PANIER --}}
                <a href="{{ route('cart') }}" class="nav-link flex items-center gap-1">
                    Panier
                    @php $count = count(session('cart', [])); @endphp
                    @if($count > 0)
                        <span class="badge">{{ $count }}</span>
                    @endif
                </a>

                @auth
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        Mon espace
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="logout-btn">
                            Déconnexion
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link">
                        Connexion
                    </a>

                    <a href="{{ route('register') }}" class="register-btn">
                        Inscription
                    </a>
                @endauth

            </div>

        </div>
    </div>

    {{-- OVERLAY --}}
    <div x-show="open"
         x-transition.opacity
         @click="open = false; submenu = null"
         class="fixed inset-0 bg-black/20 backdrop-blur-sm z-40">
    </div>

    {{-- MENU --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-x-10"
         x-transition:enter-end="opacity-100 translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-end="opacity-0 -translate-x-10"
         class="fixed inset-y-0 left-0 z-50 flex">

        {{-- LEFT PANEL --}}
        <div class="w-80 bg-white p-6 space-y-4 shadow-xl">

            <button @click="open = false; submenu = null" class="mb-4 text-xl">✕</button>

            <div class="menu-item" @click="submenu = 'actus'">Actualités →</div>
            <div class="menu-item" @click="submenu = 'equipes'">Equipes →</div>
            <div class="menu-item" @click="submenu = 'shop'">Boutique →</div>

            <div class="menu-item"><a href="/agenda">Agenda</a></div>
            <div class="menu-item"><a href="/club">Club</a></div>
            <div class="menu-item"><a href="/galerie">Galerie</a></div>
            <div class="menu-item"><a href="/contact">Contact</a></div>

            @auth
                @if(auth()->user()->role === 'admin')
                    <div class="menu-item" @click="submenu = 'admin'">Admin →</div>
                @endif
            @endauth

        </div>

        {{-- RIGHT PANEL --}}
        <div class="w-[500px] bg-white/80 backdrop-blur-md p-10 overflow-y-auto">

            {{-- DEFAULT --}}
            <div x-show="!submenu">
                <h2 class="text-2xl font-bold mb-4">Bienvenue</h2>
                <p class="text-gray-500">Sélectionne une section</p>
            </div>

            {{-- ACTUS --}}
            <div x-show="submenu === 'actus'" x-transition class="space-y-6">
                <div class="img-hover">
                    <img src="https://via.placeholder.com/400x200">
                </div>

                <h2 class="text-2xl font-bold">Actualités</h2>
                <p class="text-gray-600">Toutes les news du club</p>

                <a href="{{ route('news.index') }}"
                   @click="open = false"
                   class="submenu-btn">Voir</a>
            </div>

            {{-- SHOP --}}
            <div x-show="submenu === 'shop'" x-transition class="space-y-6">
                <div class="img-hover">
                    <img src="https://via.placeholder.com/400x200">
                </div>

                <h2 class="text-2xl font-bold">Boutique</h2>
                <p class="text-gray-600">Équipements du club</p>

                <a href="/boutique"
                   @click="open = false"
                   class="submenu-btn">Voir</a>
            </div>

            {{-- EQUIPES (FIX IMPORTANT) --}}
            <div x-show="submenu === 'equipes'" x-transition class="space-y-6">

                <h2 class="text-2xl font-bold">Nos équipes</h2>

                <div class="grid grid-cols-2 gap-4">

                    <a href="{{ route('teams.show','seniors') }}" @click="open=false" class="submenu-card">Séniors</a>
                    <a href="{{ route('teams.show','veterans') }}" @click="open=false" class="submenu-card">Vétérans</a>

                    <a href="{{ route('teams.show','u18') }}" @click="open=false" class="submenu-card">U18</a>
                    <a href="{{ route('teams.show','u14') }}" @click="open=false" class="submenu-card">U14</a>

                    <a href="{{ route('teams.show','u13') }}" @click="open=false" class="submenu-card">U13</a>
                    <a href="{{ route('teams.show','u12') }}" @click="open=false" class="submenu-card">U12</a>

                    <a href="{{ route('teams.show','u11') }}" @click="open=false" class="submenu-card">U11</a>
                    <a href="{{ route('teams.show','u10') }}" @click="open=false" class="submenu-card">U10</a>

                    <a href="{{ route('teams.show','u9') }}" @click="open=false" class="submenu-card">U9</a>
                    <a href="{{ route('teams.show','u8') }}" @click="open=false" class="submenu-card">U8</a>

                    <a href="{{ route('teams.show','u7') }}" @click="open=false" class="submenu-card">U7</a>
                    <a href="{{ route('teams.show','u6') }}" @click="open=false" class="submenu-card">U6</a>

                    <a href="{{ route('teams.show','baby') }}" @click="open=false"
                       class="submenu-card col-span-2 text-center">
                        Baby
                    </a>

                </div>

            </div>

            {{-- ADMIN --}}
            <div x-show="submenu === 'admin'" x-transition class="space-y-6">
                <h2 class="text-2xl font-bold">Admin</h2>

                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.produits.index') }}" class="submenu-card">Produits</a>
                    <a href="{{ route('admin.orders') }}" class="submenu-card">Commandes</a>
                    <a href="{{ route('admin.news.index') }}" class="submenu-card">Actualités</a>
                    <a href="{{ route('admin.teams.index') }}" class="submenu-card">Equipes</a>
                    <a href="{{ route('admin.users.index') }}" class="submenu-card">Utilisateurs</a>

                </div>
            </div>

        </div>

    </div>

</nav>

<style>
    .nav-link {
        color: white;
        padding: 6px 10px;
        border-radius: 6px;
    }
    .nav-link:hover {
        background-color: #15803d;
    }

    .menu-item {
        padding: 10px;
        font-weight: 600;
        cursor: pointer;
        border-radius: 6px;
    }
    .menu-item:hover {
        background: #f3f4f6;
        transform: translateX(5px);
    }

    .img-hover {
        overflow: hidden;
        border-radius: 12px;
    }
    .img-hover img {
        width: 100%;
        transition: transform 0.5s ease;
    }
    .img-hover:hover img {
        transform: scale(1.08);
    }

    .submenu-btn {
        background: #15803d;
        color: white;
        padding: 10px 16px;
        border-radius: 8px;
        display: inline-block;
    }

    .submenu-card {
        background: white;
        padding: 16px;
        border-radius: 12px;
        border: 1px solid #eee;
        text-align: center;
        transition: 0.3s;
    }
    .submenu-card:hover {
        background: #16a34a;
        color: white;
        transform: translateY(-5px);
    }

    .badge {
        background: red;
        font-size: 10px;
        padding: 2px 6px;
        border-radius: 999px;
    }

    .register-btn {
        background: white;
        color: #15803d;
        padding: 5px 10px;
        border-radius: 6px;
    }

    .logout-btn {
        color: rgba(255,255,255,0.7);
    }
    .logout-btn:hover {
        color: white;
    }
</style>
