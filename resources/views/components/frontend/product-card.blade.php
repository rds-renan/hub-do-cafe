@props([
    'id',
    'name',
    'description',
    'price',
    'image',
    'badge_tag' => null,
    'id' => 1
])

<div class="bg-white shadow-sm hover:shadow-lg transition overflow-hidden group">
    <div class="relative overflow-hidden">
        <img src="{{ asset($image) }}" alt="{{ $name }}" class="w-full h-64 object-cover group-hover:scale-110 transition duration-300">
        @if(!empty($badge_tag))
            <x-frontend.badge :badge_tag="$badge_tag" />
        @endif
    </div>

    <div class="p-6">
        <h3 class="font-semibold text-lg text-gray-900 mb-2">{{ $name }}</h3>
        <p>{{ $description }}</p>
        <div class="flex items-center justify-between mt-6">
            <span class="text-3xl font-bold">R$ {{ number_format($price, 2, ',', '.') }}</span>
            @auth
            <form action="{{ route('account.cart.add') }}" method="POST" class="add-to-cart-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $id }}">
                <x-frontend.button type="submit">
                    Adicionar
                </x-frontend.button >
            </form>
            @else
            <a href="{{ route('login') }}">
                <x-frontend.button>Adicionar</x-frontend.button>
            </a>
            @endauth
        </div>
    </div>
</div>
