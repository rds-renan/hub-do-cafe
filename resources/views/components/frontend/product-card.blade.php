@props(['name', 'price', 'image', 'id' => 1])

<div class="bg-white shadow-sm hover:shadow-lg transition overflow-hidden group">
    <div class="relative overflow-hidden">
        <img src="{{ asset($image) }}" alt="{{ $name }}" class="w-full h-64 object-cover group-hover:scale-110 transition duration-300">
        <button class="absolute top-4 right-4 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-amber-600 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
        </button>
    </div>

    <div class="p-6">
        <h3 class="font-semibold text-lg text-gray-900 mb-2">{{ $name }}</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros.</p>
        <div class="flex items-center justify-between mt-6">
            <span class="text-3xl font-bold">R$ {{ number_format($price, 2, ',', '.') }}</span>
            <x-frontend.button>
                Adicionar
            </x-frontend.button >
        </div>
    </div>
</div>
