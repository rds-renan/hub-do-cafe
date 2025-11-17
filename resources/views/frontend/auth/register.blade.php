<x-frontend.auth.layout title="Hub do Café - Cadastro">
    <div class="flex justify-center items-center min-h-full">
        <div class="w-full max-w-md">
            <div class="text-center py-10">
                <h1 class="text-4xl font-bold mb-6">Crie sua conta. É rapidinho.</h1>
                <p>Com uma conta, você salva seus endereços, acompanha seus pedidos e fica sabendo das novidades.</p>
            </div>
            <form class="grid gap-4" method="POST" action="{{ route('register.store') }}">
                @csrf
                <div>
                    <label for="name">Nome*</label>
                    <input
                        name="name"
                        type="text"
                        value="{{ old('name') }}"
                        class="outline-1 outline-amber-950 -outline-offset-1 focus:outline-2 focus:outline-amber-900 p-2 w-full"
                        required
                    >
                </div>
                <div>
                    <label for="email">Email*</label>
                    <input
                        name="email"
                        type="email"
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
                    Cadastrar
                </x-frontend.button>
            </form>
        </div>
    </div>
</x-frontend.auth.layout>
