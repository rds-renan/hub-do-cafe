@props(['name', 'price', 'image', 'badge_tag' => null, 'id' => 1])

<div class="bg-white shadow-sm hover:shadow-lg transition overflow-hidden group">
    <div class="relative overflow-hidden">
        <img src="{{ asset($image) }}" alt="{{ $name }}" class="w-full h-64 object-cover group-hover:scale-110 transition duration-300">
        @if(!empty($badge_tag))
            <x-frontend.badge :badge_tag="$badge_tag" />
        @endif
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
