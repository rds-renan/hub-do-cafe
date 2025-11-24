@props(['id', 'item'])

<div class="bg-white shadow-md hover:shadow-lg transition-shadow"
     data-cart-item="{{ $id }}"
     id="cart-item-{{ $id }}">
    <div class="flex gap-6">
        <!-- Imagem do Produto -->
        <div class="flex-shrink-0">
            <img src="{{ $item['image'] ? asset('/' . $item['image']) : asset('/images/products/placeholder.jpg') }}"
                 alt="{{ $item['name'] }}"
                 class="w-36 h-36 object-cover">
        </div>

        <!-- Detalhes do Produto -->
        <div class="flex-grow pt-3 pe-4">
            <div class="flex justify-between items-start mb-2">
                <h3 class="text-lg font-semibold text-gray-800">{{ $item['name'] }}</h3>
                <button onclick="removeFromCart({{ $id }})"
                        class="text-red-600 hover:text-red-800 transition-colors p-1"
                        title="Remover produto">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>

            <p class="text-2xl font-bold text-amber-950 mb-4">
                R$ {{ number_format($item['price'], 2, ',', '.') }}
            </p>

            <!-- Controle de Quantidade -->
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-600">Quantidade:</span>
                <div class="flex items-center border border-gray-300">
                    <button onclick="updateQuantity({{ $id }}, -1)"
                            class="px-2 py-1 text-gray-600 hover:bg-gray-100 transition-colors">
                        -
                    </button>
                    <span id="quantity-{{ $id }}"
                          class="px-3 py-1 font-medium min-w-[40px] text-center">
                                                {{ $item['quantity'] }}
                                            </span>
                    <button onclick="updateQuantity({{ $id }}, 1)"
                            class="px-2 py-1 text-gray-600 hover:bg-gray-100 transition-colors">
                        +
                    </button>
                </div>

                <!-- Subtotal do Item -->
                <span class="ml-auto text-lg font-semibold text-amber-950"
                      id="item-subtotal-{{ $id }}">
                                            R$ {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}
                                        </span>
            </div>
        </div>
    </div>
</div>
