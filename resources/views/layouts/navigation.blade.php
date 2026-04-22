<nav x-data="{ open: false }" class="bg-green-800"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex items-center">
                <a href="/" class="flex items-center text-white text-xl font-bold hover:text-green-200">
                    <img src="/images/logo.png" width="40" class="mr-2 rounded" onerror="this.src='https://via.placeholder.com/40'">
                    AFCLL
                </a>
            </div>

            <div class="hidden lg:flex lg:items-center lg:space-x-2">
                <a href="/" class="text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium">Accueil</a>
                <a href="/agenda" class="text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium">Agenda</a>
                <a href="/boutique" class="text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium">Boutique</a>
                <a href="/club" class="text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium">Club</a>
                <a href="/actualites" class="text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium">Actualités</a>
                <a href="/galerie" class="text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium">Galerie</a>
                <a href="/contact" class="text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium">Contact</a>

                <div class="pl-4 border-l border-green-600 flex items-center space-x-2">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-white font-bold px-3 py-2">Mon Espace</a>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="text-green-200 hover:text-white text-sm px-2">Déconnexion</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-green-200 text-sm font-medium">Connexion</a>
                        <a href="{{ route('register') }}" class="bg-white text-green-800 hover:bg-gray-100 px-3 py-1 rounded-md text-sm font-bold">Inscription</a>
                    @endauth
                </div>
            </div>

            <div class="flex items-center lg:hidden">
                <button @click="open = ! open" class="text-white hover:text-green-200 focus:outline-none p-2">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="lg:hidden bg-green-900">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="/" class="block text-white hover:bg-green-700 px-3 py-2 rounded-md text-base font-medium">Accueil</a>
            <a href="/agenda" class="block text-white hover:bg-green-700 px-3 py-2 rounded-md text-base font-medium">Agenda</a>
            <a href="/boutique" class="block text-white hover:bg-green-700 px-3 py-2 rounded-md text-base font-medium">Boutique</a>
            <a href="/club" class="block text-white hover:bg-green-700 px-3 py-2 rounded-md text-base font-medium">Club</a>
            <a href="/actualites" class="block text-white hover:bg-green-700 px-3 py-2 rounded-md text-base font-medium">Actualités</a>
            <a href="/galerie" class="block text-white hover:bg-green-700 px-3 py-2 rounded-md text-base font-medium">Galerie</a>
            <a href="/contact" class="block text-white hover:bg-green-700 px-3 py-2 rounded-md text-base font-medium">Contact</a>

            <div class="border-t border-green-700 pt-2 mt-2">
                @auth
                    <a href="{{ route('dashboard') }}" class="block text-white font-bold px-3 py-2">Mon Espace</a>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="block w-full text-left text-green-300 hover:bg-green-700 px-3 py-2 rounded-md text-base">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block text-white hover:bg-green-700 px-3 py-2 rounded-md text-base font-medium">Connexion</a>
                    <a href="{{ route('register') }}" class="block text-white hover:bg-green-700 px-3 py-2 rounded-md text-base font-medium">Inscription</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
