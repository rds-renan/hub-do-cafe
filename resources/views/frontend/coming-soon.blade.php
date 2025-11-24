<x-frontend.layout>
    <div class="flex flex-col items-center justify-center min-h-[70vh] text-center px-4">

        {{-- Ícone Temático (Café + Construção) --}}
        <div class="relative mb-6">
            <div class="p-6 bg-amber-600/20 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                </svg>
            </div>
            {{-- Ícone de engrenagem flutuante --}}
            <div class="absolute -bottom-2 -right-2 bg-white border-2 border-amber-950 rounded-full p-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-amber-600 animate-spin-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
        </div>

        {{-- Títulos e Textos --}}
        <h1 class="text-3xl font-bold text-amber-950 mb-3">
            Estamos torrando essa ideia!
        </h1>
        <p class="text-amber-900 max-w-md mb-8">
            Esta funcionalidade ainda está em desenvolvimento. Nossos baristas de código estão trabalhando nela agora mesmo.
        </p>

        {{-- Botão de Voltar --}}
        <x-frontend.button href="{{ route('home') }}" size="lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Voltar ao pagina inicial
        </x-frontend.button>
    </div>
</x-frontend.layout>
