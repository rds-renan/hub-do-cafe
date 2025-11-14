<x-frontend.layout title="Hub do Café - Início">
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

    <!-- Produtos em Destaque -->
    <section class="py-4">
        <div class="container mx-auto max-w-7xl px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">Produtos em Destaque</h2>
                <p>Confira nossa seleção especial de cafés</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Aqui você pode usar um loop com produtos --}}
                @for($i = 1; $i <= 3; $i++)
                    <x-frontend.product-card
                        :name="'Café Especial ' . $i"
                        :price="29.90"
                        :image="'images/product/coffee-' . $i . '.jpg'"
                    />
                @endfor
            </div>
        </div>
    </section>
</x-frontend.layout>
