<div id="newsletter" class="container mx-auto mt-20 flex justify-center">
    <div class="grid grid-rows-2 max-w-3xl text-center items-center justify-center">
        <div>
            <h1 class="text-4xl font-bold mb-6">Receba ofertas que mais ninguém vê</h1>
            <p>Nossos assinantes recebem acesso antecipado a produtos sazonais, descontos exclusivos e as novidades do nosso mestre de torra.</p>
        </div>
        <div>
            <form method="POST" action="{{ route('newsletter.store') }}" class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                @csrf
                <input
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    class="outline-1 outline-amber-950 -outline-offset-1 p-2 w-96"
                    placeholder="Seu melhor e-mail"
                    required
                >
                <x-frontend.button type="submit">Receber</x-frontend.button>
            </form>
            <div class="mt-2">
                <p class="text-xs">Ao se cadastrar, você concorda com nossa Política de Privacidade.</p>
            </div>
            @if(session('success'))
                <div class="mt-2 rounded bg-green-100 text-green-800 px-4 py-2 text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @error('email')
            <div class="mt-2 rounded bg-red-600 text-white px-4 py-2 text-sm">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
