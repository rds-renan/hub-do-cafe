<header class="sticky top-0 z-50 bg-white shadow-sm">
    <nav class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/logo/logo_horizontal.svg') }}" alt="Hub do Café" class="h-10">
            </a>

            <!-- Ações do Usuário -->
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('cart.review') }}" class="relative">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="absolute -top-2 -right-2 bg-amber-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                    </a>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 text-gray-700">
                            <img src="{{ asset('images/user/user-avatar.jpg') }}" alt="Avatar" class="w-8 h-8 rounded-full">
                            <span>{{ auth()->user()->name }}</span>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Meu Perfil</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Meus Pedidos</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    Sair
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <x-frontend.button variant="outline" href="{{ route('login') }}">
                        Entrar
                    </x-frontend.button>
                    <x-frontend.button variant="primary" href="{{ route('register') }}">
                        Cadastrar
                    </x-frontend.button>
                @endauth
            </div>
        </div>
    </nav>
</header>
