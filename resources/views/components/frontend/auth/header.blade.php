<header class="sticky top-0 z-50 bg-white shadow-sm">
    <nav class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/logo/logo_horizontal.svg') }}" alt="Hub do Café" class="h-10">
            </a>

            <!-- Ações do Usuário -->
            <div class="flex items-center gap-4">
                @if(Route::currentRouteName() === 'login')
                    <p>Ainda não tem conta? <a href="{{ route('register') }}" class="underline" >Cadastre-se aqui</a></p>
                @elseif(Route::currentRouteName() === 'register')
                    <p>Já é cliente? <a href="{{ route('login') }}" class="underline" >Entrar</a></p>
                @endif
            </div>
        </div>
    </nav>
</header>
