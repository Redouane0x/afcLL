<nav x-data="{ open: false, more: false, admin: false }"
     class="bg-green-700 shadow-md sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between h-16">

            {{-- LOGO --}}
            <a href="/" class="flex items-center gap-2 text-white font-bold text-lg">
                <img src="/images/logo.png" class="w-9 h-9 rounded"
                     onerror="this.src='https://via.placeholder.com/40'">
                AFCLL
            </a>

            {{-- MENU CENTER --}}
            <div class="hidden lg:flex items-center gap-6">

                <a href="/" class="nav-link">Accueil</a>
                <a href="/boutique" class="nav-link">Boutique</a>
                <a href="{{ route('buvette') }}" class="nav-link">Buvette</a>

                {{-- DROPDOWN --}}
                <div class="relative">
                    <button @click="more = !more" class="nav-link">
                        Explorer ▾
                    </button>

                    <div x-show="more"
                         @click.outside="more = false"
                         class="dropdown">

                        <a href="/agenda" class="dropdown-link">Agenda</a>
                        <a href="/club" class="dropdown-link">Club</a>
                        <a href="{{ route('news.index') }}" class="dropdown-link">Actualités</a>
                        <a href="/galerie" class="dropdown-link">Galerie</a>
                        <a href="/contact" class="dropdown-link">Contact</a>

                    </div>
                </div>

                <a href="{{ route('cart') }}" class="nav-link flex items-center gap-1">
                    Panier
                    @php $count = count(session('cart', [])); @endphp
                    @if($count > 0)
                        <span class="badge">{{ $count }}</span>
                    @endif
                </a>

                @auth
                    <a href="{{ route('orders.index') }}" class="nav-link">
                        Commandes
                    </a>
                @endauth

            </div>

            {{-- RIGHT SIDE --}}
            <div class="hidden lg:flex items-center gap-3">

                @auth

                    {{-- ADMIN --}}
                    @if(auth()->user()->role === 'admin')
                        <div class="relative">
                            <button @click="admin = !admin" class="admin-btn">
                                Admin ▾
                            </button>

                            <div x-show="admin"
                                 @click.outside="admin = false"
                                 class="dropdown right-0">

                                <a href="{{ route('admin.produits.index') }}" class="dropdown-link">
                                    Produits
                                </a>

                                <a href="{{ route('admin.buvette') }}" class="dropdown-link">
                                    Buvette
                                </a>

                                <a href="{{ route('admin.orders') }}" class="dropdown-link">
                                    Commandes
                                </a>

                                {{-- ✅ AJOUT ACTUALITÉS --}}
                                <a href="{{ route('admin.news.index') }}" class="dropdown-link">
                                    Actualités
                                </a>

                            </div>
                        </div>
                    @endif

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

            {{-- MOBILE --}}
            <button @click="open = !open" class="lg:hidden text-white text-xl">
                ☰
            </button>

        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div x-show="open" class="lg:hidden bg-green-800 px-4 py-4 space-y-2">

        <a href="/" class="mobile-link">Accueil</a>
        <a href="/boutique" class="mobile-link">Boutique</a>
        <a href="{{ route('buvette') }}" class="mobile-link">Buvette</a>

        <a href="/agenda" class="mobile-link">Agenda</a>
        <a href="/club" class="mobile-link">Club</a>
        <a href="{{ route('news.index') }}" class="mobile-link">Actualités</a>
        <a href="/galerie" class="mobile-link">Galerie</a>
        <a href="/contact" class="mobile-link">Contact</a>

        <a href="{{ route('cart') }}" class="mobile-link">
            Panier ({{ count(session('cart', [])) }})
        </a>

        @auth
            <a href="{{ route('orders.index') }}" class="mobile-link">
                Mes commandes
            </a>
        @endauth

    </div>

</nav>

<style>
    .nav-link {
        color: white;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 14px;
        transition: 0.2s;
    }
    .nav-link:hover {
        background-color: #15803d;
    }

    .dropdown {
        position: absolute;
        top: 45px;
        left: 0;
        width: 200px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        padding: 8px 0;
        z-index: 999;
    }

    .dropdown-link {
        display: block;
        padding: 8px 16px;
        font-size: 14px;
    }
    .dropdown-link:hover {
        background: #f3f4f6;
    }

    .badge {
        background: red;
        font-size: 10px;
        padding: 2px 6px;
        border-radius: 999px;
    }

    .admin-btn {
        background: white;
        color: #15803d;
        padding: 5px 10px;
        border-radius: 6px;
        font-weight: bold;
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

    .mobile-link {
        display: block;
        color: white;
        padding: 8px;
        border-radius: 6px;
    }
    .mobile-link:hover {
        background: #15803d;
    }
</style>
