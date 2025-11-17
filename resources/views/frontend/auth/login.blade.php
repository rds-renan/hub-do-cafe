<x-frontend.auth.layout title="Hub do Café - Login">
    <div class="flex justify-center items-center min-h-full">
        <div class="w-full max-w-md">
            <div class="text-center py-10">
                <h1 class="text-4xl font-bold mb-6">Acesse sua conta</h1>
                <p>Faça login para fazer pedidos mais rápido e salvar seus favoritos.</p>
            </div>
            <form class="grid gap-4" method="POST" action="{{ route('login') }}" x-data="{ email: '', password: '' }">
                @csrf
                <div>
                    <label for="email">Email*</label>
                    <input
                        name="email"
                        type="email"
                        x-model="email"
                        value="{{ old('email') }}"
                        class="outline-1 outline-amber-950 -outline-offset-1 focus:outline-2 focus:outline-amber-900 p-2 w-full"
                        required
                    >
                </div>
                <div>
                    <label for="password">Senha*</label>
                    <input
                        name="password"
                        type="password"
                        x-model="password"
                        value="{{ old('password') }}"
                        class="outline-1 outline-amber-950 -outline-offset-1 focus:outline-2 focus:outline-amber-900 p-2 w-full"
                        required
                    >
                </div>

                @if(session('error'))
                    <div class="mt-2 rounded bg-red-100 text-red-800 px-4 py-2 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <x-frontend.button type="submit">
                    Entrar
                </x-frontend.button>

                <div class="text-center">
                    <a href="{{ route('password.request') }}" class="underline">Esqueci minha senha</a>
                </div>

                <div class="grid gap-3 mt-8 text-center">
                    <p>Use os botões para preencher o login como usuário específico</p>
                    <div class="flex">
                        <x-frontend.button @click="email='cliente@teste.com';password='Client@258'">
                            Cliente
                        </x-frontend.button>
                        <x-frontend.button @click="email='admin@hubdocafe.rds.dev.br';password='Admin#147'">
                            Administrador
                        </x-frontend.button>
                        <x-frontend.button @click="email='atendente@hubdocafe.rds.dev.br';password='Atendente#369'">
                            Atendente
                        </x-frontend.button>
                        <x-frontend.button @click="email='entregador@hubdocafe.rds.dev.br';password='Entregador#470'">
                            Entregador
                        </x-frontend.button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-frontend.auth.layout>
