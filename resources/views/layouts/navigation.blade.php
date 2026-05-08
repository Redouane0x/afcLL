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
            </div>

            {{-- RIGHT --}}
            <div class="hidden lg:flex items-center gap-3">

                <a href="{{ route('cart') }}" class="nav-link flex items-center gap-1">
                    🛒
                    @php $count = count(session('cart', [])); @endphp
                    @if($count > 0)
                        <span class="badge">{{ $count }}</span>
                    @endif
                </a>

                @auth
                    <a href="{{ route('dashboard') }}" class="nav-link">Mon espace</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="logout-btn">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Connexion</a>
                    <a href="{{ route('register') }}" class="register-btn">Inscription</a>
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

        {{-- LEFT --}}
        <div class="w-80 bg-white p-6 space-y-4 shadow-xl">

            <button @click="open = false; submenu = null" class="mb-4 text-xl">✕</button>

            <div class="menu-item" @click="submenu = 'actus'">Actualités ></div>
            <div class="menu-item" @click="submenu = 'equipes'">Equipes ></div>
            <div class="menu-item" @click="submenu = 'shop'">Boutique ></div>

            <div class="menu-item"><a href="/agenda">Agenda</a></div>
            <div class="menu-item"><a href="/club">Club</a></div>
            <div class="menu-item"><a href="/galerie">Galerie</a></div>
            <div class="menu-item"><a href="/contact">Contact</a></div>

            @auth
                @if(auth()->user()->role === 'admin')
                    <div class="menu-item" @click="submenu = 'admin'">Admin ></div>
                @endif
            @endauth

        </div>

        {{-- RIGHT --}}
        <div class="w-[500px] bg-white/70 backdrop-blur-sm p-10 overflow-y-auto">

            {{-- DEFAULT --}}
            <div x-show="!submenu">
                <h2 class="text-2xl font-bold mb-4">Bienvenue</h2>
                <p class="text-gray-500">Sélectionne une section</p>
            </div>

            {{-- ACTUS --}}
            <div x-show="submenu === 'actus'"
                 x-transition
                 class="space-y-6">

                <div class="img-hover">
                    <img src="https://via.placeholder.com/400x200">
                </div>

                <h2 class="text-2xl font-bold">Actualités</h2>

                <p class="text-gray-600 leading-relaxed">
                    Toutes les news du club
                </p>

                <div class="pt-2">
                    <a href="{{ route('news.index') }}" class="submenu-btn">
                        Voir
                    </a>
                </div>

            </div>

            {{-- SHOP --}}
            <div x-show="submenu === 'shop'"
                 x-transition
                 class="space-y-6">

                <div class="img-hover">
                    <img src="https://via.placeholder.com/400x200">
                </div>

                <h2 class="text-2xl font-bold">Boutique</h2>

                <p class="text-gray-600">
                    Équipements du club
                </p>

                <a href="/boutique" class="submenu-btn">
                    Voir
                </a>

            </div>

            {{-- EQUIPES --}}
            <div x-show="submenu === 'equipes'"
                 x-transition
                 class="space-y-6">

                <h2 class="text-2xl font-bold">Equipes</h2>

                <div class="grid grid-cols-2 gap-6">
                    <div class="submenu-card">Seniors</div>
                    <div class="submenu-card">U18</div>
                    <div class="submenu-card">U15</div>
                    <div class="submenu-card">U13</div>
                </div>

            </div>

            {{-- ADMIN --}}
            <div x-show="submenu === 'admin'"
                 x-transition
                 class="space-y-8">

                <h2 class="text-3xl font-bold">Admin</h2>

                <div class="grid grid-cols-2 gap-6">
                    <a href="{{ route('admin.produits.index') }}" class="submenu-card">Produits</a>
                    <a href="{{ route('admin.orders') }}" class="submenu-card">Commandes</a>
                    <a href="{{ route('admin.news.index') }}" class="submenu-card">Actus</a>
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
        transition: 0.2s;
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
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #15803d;
        color: white;
        padding: 10px 16px;
        border-radius: 8px;
        font-weight: 600;
        transition: 0.25s;
    }
    .submenu-btn::after {
        content: "→";
        transition: 0.25s;
    }
    .submenu-btn:hover::after {
        transform: translateX(5px);
    }

    .submenu-card {
        background: white;
        padding: 20px;
        border-radius: 14px;
        border: 1px solid #eee;
        transition: 0.3s;
    }
    .submenu-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
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
