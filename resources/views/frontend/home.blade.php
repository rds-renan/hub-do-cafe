<x-frontend.layout title="Hub do Café - Início">
    <section class="py-4" x-data="{ selected: 'cafes' }">
        <div class="container mx-auto max-w-7xl px-4">
            <!-- Hero Section -->
            <section class="py-20">
                <div class="container mx-auto px-4">
                    <div class="max-w-2xl mx-auto text-center">
                        <h1 class="text-5xl font-bold mb-6">
                            O sabor do café especial, agora na sua casa.
                        </h1>
                        <p class="text-lg">
                            Transforme sua pausa em um ritual. Oferecemos o melhor do café especial, acompanhamentos frescos e a facilidade de pedir sem sair de casa.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Menu de categorias -->
            <div class="flex justify-center gap-10 mb-10">
                <button @click="selected='cafes'"
                        :class="selected==='cafes' ? 'text-amber-600 font-semibold' : 'text-gray-600'">
                    Cafés
                </button>
                <button @click="selected='salgados'"
                        :class="selected==='salgados' ? 'text-amber-600 font-semibold' : 'text-gray-600'">
                    Salgados
                </button>
                <button @click="selected='combos'"
                        :class="selected==='combos' ? 'text-amber-600 font-semibold' : 'text-gray-600'">
                    Combos
                </button>
            </div>

            <!-- Grid de produtos -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div x-show="selected === '{{ $product->categoria }}'"
                         x-transition
                         class="will-change-transform">
                        <x-frontend.product-card
                            :name="$product->name"
                            :description="$product->description"
                            :price="$product->price"
                            :image="$product->image"
                            :badge_tag="$product->badge_tag"
                        />
                    </div>
                @endforeach
            </div>

            <!-- CTA -->
            <x-frontend.cta/>
        </div>
    </section>
</x-frontend.layout>
