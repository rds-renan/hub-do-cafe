<x-frontend.layout title="Revise seu pedido">
    <div class="container mx-auto px-4 pt-16  pb-8 max-w-7xl">
        <h1 class="text-3xl font-bold text-amber-950 mb-8">Revise seu pedido</h1>

        @if(empty($cart) || count($cart) === 0)
            <!-- Carrinho Vazio -->
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="#461901" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h2 class="text-2xl font-semibold text-gray-700 mb-2">Seu carrinho está vazio</h2>
                <p class="text-gray-500 mb-6">Adicione produtos deliciosos para começar seu pedido!</p>
                <x-frontend.button href="{{ route('home') }}" >
                    Ver Produtos
                </x-frontend.button>
            </div>
        @else
            <!-- Grid Layout: Produtos + Resumo -->
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Lista de Produtos (2/3) -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cart as $id => $item)
                        <x-frontend.cart.product-review-card :id="$id" :item="$item" />
                    @endforeach

                    <!-- Botão Limpar Carrinho -->
                    <div class="flex justify-end mt-4">
                        <button onclick="clearCart()"
                                class="text-red-600 hover:text-red-800 font-medium flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Limpar Carrinho
                        </button>
                    </div>
                </div>

                <!-- Resumo do Pedido (1/3) -->
                <div class="lg:col-span-1">
                    <div class="bg-white shadow-md p-6 sticky top-4 border-s-2 border-s-amber-600">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 pb-3">
                            Resumo do Pedido
                        </h2>

                        <!-- Detalhes do Resumo -->
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-gray-700">
                                <span>Subtotal:</span>
                                <span id="summary-subtotal" class="font-medium">
                                    R$ {{ number_format($cartSubtotal, 2, ',', '.') }}
                                </span>
                            </div>

                            <div class="flex justify-between text-gray-700">
                                <span>Frete:</span>
                                <span id="summary-shipping" class="font-medium">
                                    @if($shipping == 0)
                                        <span class="text-green-600 font-semibold">Grátis</span>
                                    @else
                                        <span class="text-green-600 font-semibold">A calcular</span>
                                    @endif
                                </span>
                            </div>

                            @if($cartSubtotal < 100 && $shipping > 0)
                                <div class="bg-amber-50 border border-amber-900 p-3">
                                    <p class="text-xs text-amber-950 text-center">
                                        Faltam <strong>R$ {{ number_format(100 - $cartSubtotal, 2, ',', '.') }}</strong>
                                        para frete grátis!
                                    </p>
                                </div>
                            @endif

                            <div class="border-t pt-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-gray-800">Total:</span>
                                    <span id="summary-total" class="text-2xl font-bold text-[#461901]">
                                        R$ {{ number_format($cartTotal, 2, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="space-y-3">
                            <x-frontend.button href="{{ route('account.checkout') }}" class="w-full">
                                Seguir para pagamento
                            </x-frontend.button>

                            <x-frontend.button href="{{ route('home') }}" variant="outline" class="w-full">
                                Continuar Comprando
                            </x-frontend.button>
                        </div>

                        <!-- Informações Adicionais -->
                        <div class="mt-6 pt-6 border-t space-y-3 text-sm text-gray-600">
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Entrega rápida e segura</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Produtos frescos e selecionados</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Pagamento seguro</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        // Função para atualizar quantidade
        async function updateQuantity(productId, change) {
            const quantityElement = document.getElementById(`quantity-${productId}`);
            let currentQuantity = parseInt(quantityElement.textContent);
            let newQuantity = currentQuantity + change;

            // Não permite quantidade menor que 1
            if (newQuantity < 1) return;

            try {
                let url = "{{ route('account.cart.update', ':product') }}"
                url = url.replace(':product', productId);
                const response = await fetch(url, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ quantity: newQuantity })
                });

                const data = await response.json();

                if (data.success) {
                    // Atualiza a quantidade
                    quantityElement.textContent = newQuantity;

                    // Atualiza subtotal do item
                    const itemPrice = {!! json_encode(array_map(fn($item) => $item['price'], $cart)) !!}[productId];
                    document.getElementById(`item-subtotal-${productId}`).textContent =
                        `R$ ${(itemPrice * newQuantity).toFixed(2).replace('.', ',')}`;

                    // Recarrega a página para atualizar todos os valores
                    location.reload();
                }
            } catch (error) {
                console.error('Erro ao atualizar quantidade:', error);
                alert('Erro ao atualizar quantidade. Tente novamente.');
            }
        }

        // Função para remover produto do carrinho
        async function removeFromCart(productId) {
            try {
                let url = "{{ route('account.cart.destroy', ':product') }}"
                url = url.replace(':product', productId);
                const response = await fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Remove o elemento visualmente
                    const itemElement = document.getElementById(`cart-item-${productId}`);
                    itemElement.style.transition = 'opacity 0.3s';
                    itemElement.style.opacity = '0';

                    setTimeout(() => {
                        // Recarrega a página para atualizar tudo
                        location.reload();
                    }, 300);
                }
            } catch (error) {
                window.showNotification('Erro ao remover produto. Tente novamente.', 'error');
            }
        }

        // Função para limpar carrinho
        async function clearCart() {
            try {
                const response = await fetch('{{ route('account.cart.clear') }}', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    location.reload();
                }
            } catch (error) {
                window.showNotification('Erro ao limpar carrinho. Tente novamente.', 'error');
            }
        }
    </script>
    @endpush
</x-frontend.layout>
