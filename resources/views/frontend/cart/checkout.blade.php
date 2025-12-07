<x-frontend.layout title="Pagamento">
    <div class="container mx-auto px-4 pt-16 pb-8 max-w-7xl">
        <h1 class="text-3xl font-bold text-amber-950 mb-3">Checkout</h1>
        <p>Escola o metodo de pagamento e a como deseja obter seus produtos.</p>

        <!-- Grid Layout: Delivery + Resumo -->
        <div class="grid lg:grid-cols-2 gap-12 mt-12">

            <!-- Delivery method (1/2) -->
            <div class="lg:col-span-1 space-y-4" x-data="deliverySection()">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Método de Entrega</h2>

                <!-- Opção Retirar no Local -->
                <div>
                    <label class="flex items-center justify-between w-full h-24 px-6 border-2 border-gray-300 cursor-pointer hover:border-amber-600 transition-colors has-[:checked]:border-amber-950 has-[:checked]:bg-amber-50 group">
                        <div class="flex items-center gap-6">
                            <svg class="w-12 h-12 fill-gray-800 group-has-[:checked]:fill-amber-900" viewBox="0 0 24 24">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-800">Retirar no Local</span>
                                <span class="font-medium text-gray-500 text-sm">Retire seu pedido em nossa loja</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-green-600 font-bold">Grátis</span>
                            <input type="radio" name="delivery_method" value="pickup" class="w-5 h-5 text-amber-600 accent-amber-900" x-model="deliveryMethod">
                        </div>
                    </label>

                    <!-- Área de informações - Retirar no Local -->
                    <div x-show="deliveryMethod === 'pickup'" x-collapse class="bg-white shadow-md sticky border-s-2 border-s-amber-600 p-6">
                        <div class="flex items-start gap-4">
                            <svg class="w-8 h-8 text-amber-900 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div>
                                <h3 class="font-bold text-gray-800">Hub do Café</h3>
                                <p class="text-gray-600 text-sm mt-1">Rua Exemplo, 123 - Centro</p>
                                <p class="text-gray-600 text-sm">São Paulo - SP, 01234-567</p>
                                <p class="text-gray-500 text-sm mt-2">
                                    <strong>Horário de funcionamento:</strong><br>
                                    Seg a Sex: 8h às 18h | Sáb: 8h às 14h
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Opção Entrega -->
                <div>
                    <label class="flex items-center justify-between w-full h-24 px-6 border-2 border-gray-300 cursor-pointer hover:border-amber-600 transition-colors has-[:checked]:border-amber-950 has-[:checked]:bg-amber-50 group">
                        <div class="flex items-center gap-6">
                            <svg class="w-12 h-12 fill-gray-800 group-has-[:checked]:fill-amber-900" viewBox="0 0 24 24">
                                <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5H15V3H9v2H6.5c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                            </svg>
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-800">Receber em Casa</span>
                                <span class="font-medium text-gray-500 text-sm">Entrega em até 10km - R$ 1,00 por km</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-amber-700 font-bold text-sm" x-text="shippingCost > 0 ? 'R$ ' + shippingCost.toFixed(2).replace('.', ',') : 'A calcular'"></span>
                            <input type="radio" name="delivery_method" value="delivery" class="w-5 h-5 text-amber-600 accent-amber-900" x-model="deliveryMethod">
                        </div>
                    </label>

                    <!-- Área de Entrega -->
                    <div x-show="deliveryMethod === 'delivery'" x-collapse class="bg-white shadow-md sticky border-s-2 border-s-amber-600 p-6 space-y-6">

                        <!-- Mapa -->
                        <div>
                            <h3 class="font-bold text-gray-800 mb-3">Área de Entrega</h3>
                            <p class="text-sm text-gray-600 mb-3">Clique no mapa para selecionar seu endereço ou use a busca abaixo.</p>

                            <!-- Container do Mapa -->
                            <div id="delivery-map" class="w-full h-72 rounded-lg border-2 border-gray-300 z-0"></div>

                            <!-- Info de distância -->
                            <div class="mt-3 p-3 rounded-lg" :class="isWithinRange ? 'bg-green-100 border border-green-300' : (distance > 0 ? 'bg-red-100 border border-red-300' : 'bg-gray-100 border border-gray-300')">
                                <template x-if="distance > 0">
                                    <div class="flex items-center justify-between">
                                        <div>
                                                <span class="font-medium" :class="isWithinRange ? 'text-green-800' : 'text-red-800'">
                                                    Distância: <span x-text="distance.toFixed(2)"></span> km
                                                </span>
                                            <template x-if="isWithinRange">
                                                <span class="text-green-700 text-sm block">✓ Dentro da área de entrega</span>
                                            </template>
                                            <template x-if="!isWithinRange">
                                                <span class="text-red-700 text-sm block">✗ Fora da área de entrega (máx. 10km)</span>
                                            </template>
                                        </div>
                                        <template x-if="isWithinRange">
                                            <span class="font-bold text-green-800">R$ <span x-text="shippingCost.toFixed(2).replace('.', ',')"></span></span>
                                        </template>
                                    </div>
                                </template>
                                <template x-if="distance === 0">
                                    <span class="text-gray-600 text-sm">Selecione um endereço no mapa ou escolha um endereço salvo</span>
                                </template>
                            </div>
                        </div>

                        <!-- Endereços Salvos -->
                        <div>
                            <h3 class="font-bold text-gray-800 mb-3">Endereços Salvos</h3>

                            <template x-if="savedAddresses.length === 0">
                                <p class="text-gray-500 text-sm italic">Você ainda não tem endereços salvos.</p>
                            </template>

                            <div class="space-y-2">
                                <template x-for="(address, index) in savedAddresses" :key="index">
                                    <label class="flex items-center gap-4 p-4 border-2 border-gray-200 cursor-pointer hover:border-amber-600 transition-colors has-[:checked]:border-amber-950 has-[:checked]:bg-white rounded-lg">
                                        <input type="radio" name="selected_address" :value="index" class="w-4 h-4 text-amber-600 accent-amber-900" x-model="selectedAddressIndex" @change="selectSavedAddress(index)">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2">
                                                <span class="font-bold text-gray-800" x-text="address.label"></span>
                                                <template x-if="address.isDefault">
                                                    <span class="text-xs bg-amber-100 text-amber-800 px-2 py-0.5 rounded">Padrão</span>
                                                </template>
                                            </div>
                                            <p class="text-sm text-gray-600" x-text="address.street + ', ' + address.number"></p>
                                            <p class="text-sm text-gray-500" x-text="address.neighborhood + ' - ' + address.city + '/' + address.state"></p>
                                        </div>
                                        <button type="button" @click.prevent="removeAddress(index)" class="text-red-500 hover:text-red-700 p-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </label>
                                </template>
                            </div>
                        </div>

                        <!-- Cadastrar Novo Endereço -->
                        <div>
                            <button type="button" @click="showNewAddressForm = !showNewAddressForm" class="flex items-center gap-2 text-amber-700 hover:text-amber-900 font-medium">
                                <svg class="w-5 h-5 transition-transform" :class="showNewAddressForm ? 'rotate-45' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                <span x-text="showNewAddressForm ? 'Cancelar' : 'Adicionar novo endereço'"></span>
                            </button>

                            <!-- Formulário Novo Endereço -->
                            <div x-show="showNewAddressForm" x-collapse class="mt-4 p-4 bg-white rounded-lg border border-gray-200 space-y-4">
                                <h4 class="font-bold text-gray-800">Novo Endereço</h4>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="col-span-2 sm:col-span-1">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Nome do Endereço</label>
                                        <input type="text" x-model="newAddress.label" placeholder="Ex: Casa, Trabalho" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">CEP</label>
                                        <input type="text" x-model="newAddress.zipcode" @blur="searchCep()" placeholder="00000-000" maxlength="9" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Rua</label>
                                    <input type="text" x-model="newAddress.street" placeholder="Nome da rua" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-amber-500 focus:border-amber-500">
                                </div>

                                <div class="grid grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Número</label>
                                        <input type="text" x-model="newAddress.number" placeholder="123" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                    <div class="col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Complemento</label>
                                        <input type="text" x-model="newAddress.complement" placeholder="Apto, Bloco, etc." class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Bairro</label>
                                        <input type="text" x-model="newAddress.neighborhood" placeholder="Bairro" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Cidade</label>
                                        <input type="text" x-model="newAddress.city" placeholder="Cidade" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                                        <input type="text" x-model="newAddress.state" placeholder="UF" maxlength="2" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                </div>

                                <div class="flex items-center gap-2">
                                    <input type="checkbox" x-model="newAddress.isDefault" id="default-address" class="w-4 h-4 text-amber-600 accent-amber-900 rounded">
                                    <label for="default-address" class="text-sm text-gray-700">Definir como endereço padrão</label>
                                </div>

                                <div class="flex gap-3 pt-2">
                                    <button type="button"
                                            @click="saveNewAddress()"
                                            x-bind:disabled="isLoading"
                                            class="flex-1 inline-flex items-center justify-center font-medium transition bg-amber-950 text-white hover:bg-amber-900 px-6 py-2 text-base disabled:opacity-50 disabled:cursor-not-allowed">
                                        <span x-show="!isLoading">Salvar Endereço</span>
                                        <span x-show="isLoading">Salvando...</span>
                                    </button>
                                    <button type="button"
                                            @click="showNewAddressForm = false; resetNewAddress()"
                                            x-bind:disabled="isLoading"
                                            class="inline-flex items-center justify-center font-medium transition outline-2 -outline-offset-2 border-amber-950 text-amber-950 hover:bg-amber-50 px-6 py-2 text-base disabled:opacity-50 disabled:cursor-not-allowed">
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resumo do Pedido (1/2) -->
            <div class="lg:col-span-1">

                <!-- Method of Payment -->
                <div class="space-y-3" x-data="{ paymentMethod: null }">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Método de Pagamento</h2>

                    <!-- Card option -->
                    <div>
                        <label class="flex items-center justify-between w-full h-24 px-6 border-2 border-gray-300 cursor-pointer hover:border-amber-600 transition-colors has-[:checked]:border-amber-950 has-[:checked]:bg-amber-50 group">
                            <div class="flex items-center gap-6">
                                <svg class="w-12 h-12 fill-gray-800 group-has-[:checked]:fill-amber-900" viewBox="0 0 50 40">
                                    <path d="M4.19434 0.5H45.791C46.7902 0.5 47.6501 0.859679 48.3945 1.60156H48.3955C49.1402 2.34315 49.5 3.19966 49.5 4.19336V35.8213C49.5 36.7484 49.1841 37.5557 48.5312 38.2617L48.3955 38.4023C47.6512 39.1416 46.7908 39.5 45.791 39.5H4.19434C3.19922 39.5 2.34216 39.1415 1.60059 38.4023C0.858757 37.6636 0.5 36.8109 0.5 35.8213V4.19336L0.503906 4.00879C0.545992 3.09254 0.905802 2.29679 1.60156 1.60156V1.60059C2.29698 0.905147 3.09339 0.545969 4.00977 0.503906L4.19434 0.5ZM3.69434 36.3213H46.291V18.1289H4.69434V11.2168H46.291V3.69336H3.69434V36.3213Z" />
                                </svg>
                                <div class="flex flex-col">
                                    <span class="font-bold text-gray-800">Pague com cartão de crédito/débito</span>
                                    <span class="font-medium text-gray-800">Pague usando seu cartão de débito/crédito, aceitamos as bandeiras.</span>
                                </div>
                            </div>
                            <input type="radio" name="payment_method" value="card" class="w-5 h-5 text-amber-600 accent-amber-900" x-model="paymentMethod">
                        </label>

                        <!-- Inputs card -->
                        <div x-show="paymentMethod === 'card'" x-collapse class="bg-white shadow-md sticky border-s-2 border-s-amber-600 p-6 space-y-4">
                            <div>
                                <label for="card_number" class="block text-sm font-medium text-gray-700 mb-1">Número do Cartão</label>
                                <input type="text" id="card_number" name="card_number" placeholder="0000 0000 0000 0000" x-mask="9999 9999 9999 9999" maxlength="19" class="w-full px-4 py-2 border border-gray-300 focus:ring-amber-500 focus:border-amber-500">
                            </div>
                            <div>
                                <label for="card_holder" class="block text-sm font-medium text-gray-700 mb-1">Nome no Cartão</label>
                                <input type="text" id="card_holder" name="card_holder" placeholder="Nome como está no cartão" class="w-full px-4 py-2 border border-gray-300 focus:ring-amber-500 focus:border-amber-500">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="card_expiry" class="block text-sm font-medium text-gray-700 mb-1">Validade</label>
                                    <input type="text" id="card_expiry" name="card_expiry" placeholder="MM/AA" x-mask="99/99" maxlength="5" class="w-full px-4 py-2 border border-gray-300 focus:ring-amber-500 focus:border-amber-500">
                                </div>
                                <div>
                                    <label for="card_cvv" class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                                    <input type="text" id="card_cvv" name="card_cvv" placeholder="123" maxlength="3" class="w-full px-4 py-2 border border-gray-300 focus:ring-amber-500 focus:border-amber-500">
                                </div>
                            </div>
                            <div class="bg-red-500 text-white p-2 mt-2 text-center">
                                <p>Projeto Acadêmico: Não realize pagamentos. Este pedido é uma simulação.</p>
                            </div>
                        </div>
                    </div>

                    <!-- PIX option -->
                    <div>
                        <label class="flex items-center justify-between w-full h-24 px-6 border-2 border-gray-300 cursor-pointer hover:border-amber-600 transition-colors has-[:checked]:border-amber-950 has-[:checked]:bg-amber-50 group">
                            <div class="flex items-center gap-6 ">
                                <svg class="w-12 h-12 fill-gray-800 group-has-[:checked]:fill-[#77B6A8]" viewBox="0 0 50 50">
                                    <path d="M25 0C22.8365 0 20.7928 0.84241 19.2603 2.3748L9.65504 11.9797H12.9103C14.5128 11.9797 16.0255 12.6004 17.1573 13.7422L23.9377 20.5223C24.5187 21.1032 25.4813 21.1034 26.0623 20.5125L32.8427 13.7422C33.9745 12.6004 35.4872 11.9797 37.0897 11.9797H40.345L30.7397 2.3748C29.2072 0.84241 27.1635 0 25 0ZM7.65182 13.9828L2.37381 19.2606C-0.791271 22.4255 -0.791271 27.5745 2.37381 30.7394L7.65182 36.0172H12.9103C13.982 36.0172 14.9837 35.5966 15.7449 34.8455L22.5253 28.0653C23.8875 26.7032 26.1125 26.7032 27.4747 28.0653L34.2551 34.8455C35.0163 35.5966 36.018 36.0172 37.0897 36.0172H42.3482L47.6262 30.7394C50.7913 27.5745 50.7913 22.4255 47.6262 19.2606L42.3482 13.9828H37.0897C36.018 13.9828 35.0163 14.4034 34.2551 15.1545L27.4747 21.9347C26.7936 22.6157 25.9014 22.9577 25 22.9577C24.0986 22.9577 23.2064 22.6157 22.5253 21.9347L15.7449 15.1545C14.9837 14.4034 13.982 13.9828 12.9103 13.9828H7.65182ZM25 29.0434C24.6144 29.0447 24.2282 29.192 23.9377 29.4875L17.1573 36.2578C16.0255 37.3996 14.5128 38.0203 12.9103 38.0203H9.65504L19.2603 47.6252C20.7928 49.1576 22.8365 50 25 50C27.1635 50 29.2072 49.1576 30.7397 47.6252L40.345 38.0203H37.0897C35.4872 38.0203 33.9745 37.3996 32.8427 36.2578L26.0623 29.4777C25.7718 29.1872 25.3856 29.0422 25 29.0434Z" />
                                </svg>
                                <div class="flex flex-col">
                                    <span class="font-medium text-gray-800">PIX</span>
                                    <span class="font-medium text-gray-800">Pague no Pix QR Code ou copia e cola....</span>
                                </div>
                            </div>
                            <input type="radio" name="payment_method" value="pix" class="w-5 h-5 text-amber-600 accent-amber-900" x-model="paymentMethod">
                        </label>

                        <!-- Área de inputs do PIX -->
                        <div x-show="paymentMethod === 'pix'" x-collapse class="bg-white shadow-md sticky border-s-2 border-s-amber-600 p-6 space-y-4">
                            <div class="text-center">
                                <p class="text-gray-700 mb-4">Escaneie o QR Code abaixo ou copie o código PIX:</p>
                                <!-- Placeholder para QR Code -->
                                <div class="w-48 h-48 mx-auto flex items-center justify-center mb-4">
                                    <img
                                        src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=HubDoCafe-Pagamento-Teste"
                                        alt="QR Code Pix"
                                        class="w-48 h-48"
                                    >
                                </div>
                                <div>
                                    <label for="pix_code" class="block text-sm font-medium text-gray-700 mb-1">Código PIX (Copia e Cola)</label>
                                    <div class="flex gap-2">
                                        <input type="text" id="pix_code" name="pix_code" value="00020126580014br.gov.bcb.pix..." readonly class="w-full px-4 py-2 border border-gray-300 bg-gray-100 text-gray-600">
                                        <button type="button" onclick="navigator.clipboard.writeText(document.getElementById('pix_code').value)" class="px-4 py-2 bg-amber-600 text-white hover:bg-amber-700 transition-colors">
                                            Copiar
                                        </button>
                                    </div>
                                </div>
                                <div class="bg-red-500 text-white p-2 mt-2">
                                    <p>Projeto Acadêmico: Não realize pagamentos. Este pedido é uma simulação.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-md p-6 mt-6 sticky border-s-2 border-s-amber-600">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 pb-3">
                        Resumo do Pedido
                    </h2>

                    <!-- Detalhes do Resumo -->
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-700">
                            <span>Produtos:</span>
                            <span id="summary-subtotal" class="font-medium">
                                R$ {{ number_format($cartSubtotal, 2, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex justify-between text-gray-700">
                            <span>Entrega:</span>
                            <span id="summary-shipping" class="font-medium">
                                    @if($shipping == 0)
                                    <span class="text-green-600 font-semibold">Grátis</span>
                                @else
                                    <span class="text-green-600 font-semibold">A calcular</span>
                                @endif
                            </span>
                        </div>

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
                        <x-frontend.button href="{{ route('coming.soon') }}" class="w-full">
                            Finalizar Pedido
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
    </div>

    @push('scripts')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        <script>
            function deliverySection() {
                return {
                    deliveryMethod: null,
                    selectedAddressIndex: null,
                    showNewAddressForm: false,
                    distance: 0,
                    shippingCost: 0,
                    isWithinRange: false,
                    maxDistance: 10, // km
                    pricePerKm: 1, // R$ por km
                    isLoading: false,

                    // Coordenadas da loja (Hub do Café)
                    storeLocation: {
                        lat: -23.550520,
                        lng: -46.633308
                    },

                    // Endereços salvos do usuário
                    savedAddresses: @json($addresses ?? []),

                    newAddress: {
                        label: '',
                        street: '',
                        number: '',
                        complement: '',
                        neighborhood: '',
                        city: '',
                        state: '',
                        zipcode: '',
                        lat: null,
                        lng: null,
                        isDefault: false
                    },

                    map: null,
                    storeMarker: null,
                    deliveryMarker: null,
                    deliveryCircle: null,
                    routeLine: null,

                    init() {
                        this.$watch('deliveryMethod', (value) => {
                            if (value === 'delivery') {
                                this.$nextTick(() => {
                                    this.initMap();
                                });
                            }
                        });

                        const defaultIndex = this.savedAddresses.findIndex(addresses => addresses.isDefault);
                        if (defaultIndex !== -1) {
                            this.selectedAddressIndex = defaultIndex;
                        }
                    },

                    initMap() {
                        if (this.map) {
                            this.map.invalidateSize();
                            return;
                        }

                        // Inicializa o mapa
                        this.map = L.map('delivery-map').setView([this.storeLocation.lat, this.storeLocation.lng], 13);

                        // Adiciona o tile layer (OpenStreetMap)
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '© OpenStreetMap contributors'
                        }).addTo(this.map);

                        // Ícone personalizado para a loja
                        const storeIcon = L.divIcon({
                            html: `<div class="flex items-center justify-center w-10 h-10 bg-amber-600 rounded-full border-4 border-white shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                    </svg>
                                </div>`,
                            className: '',
                            iconSize: [40, 40],
                            iconAnchor: [20, 40]
                        });

                        // Marcador da loja
                        this.storeMarker = L.marker([this.storeLocation.lat, this.storeLocation.lng], { icon: storeIcon })
                            .addTo(this.map)
                            .bindPopup('<strong>Hub do Café</strong><br>Nossa loja');

                        // Círculo de raio de entrega (10km)
                        this.deliveryCircle = L.circle([this.storeLocation.lat, this.storeLocation.lng], {
                            color: '#92400e',
                            fillColor: '#fef3c7',
                            fillOpacity: 0.2,
                            radius: this.maxDistance * 1000 // metros
                        }).addTo(this.map);

                        // Clique no mapa para selecionar endereço
                        this.map.on('click', (e) => {
                            this.setDeliveryLocation(e.latlng.lat, e.latlng.lng);
                            this.selectedAddressIndex = null;
                        });

                        // Ajusta o zoom para mostrar o círculo
                        this.map.fitBounds(this.deliveryCircle.getBounds());
                    },

                    setDeliveryLocation(lat, lng) {
                        // Remove marcador anterior
                        if (this.deliveryMarker) {
                            this.map.removeLayer(this.deliveryMarker);
                        }
                        if (this.routeLine) {
                            this.map.removeLayer(this.routeLine);
                        }

                        // Ícone do destino
                        const deliveryIcon = L.divIcon({
                            html: `<div class="flex items-center justify-center w-8 h-8 bg-red-600 rounded-full border-3 border-white shadow-lg">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>`,
                            className: '',
                            iconSize: [32, 32],
                            iconAnchor: [16, 32]
                        });

                        // Adiciona marcador
                        this.deliveryMarker = L.marker([lat, lng], { icon: deliveryIcon })
                            .addTo(this.map)
                            .bindPopup('Local de entrega');

                        // Desenha linha entre loja e destino
                        this.routeLine = L.polyline([
                            [this.storeLocation.lat, this.storeLocation.lng],
                            [lat, lng]
                        ], {
                            color: '#92400e',
                            weight: 3,
                            dashArray: '10, 10'
                        }).addTo(this.map);

                        // Calcula a distância
                        this.calculateDistance(lat, lng);
                    },

                    calculateDistance(lat, lng) {
                        const R = 6371; // Raio da Terra em km
                        const dLat = this.toRad(lat - this.storeLocation.lat);
                        const dLng = this.toRad(lng - this.storeLocation.lng);
                        const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                            Math.cos(this.toRad(this.storeLocation.lat)) * Math.cos(this.toRad(lat)) *
                            Math.sin(dLng / 2) * Math.sin(dLng / 2);
                        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                        this.distance = R * c;

                        // Verifica se está dentro do raio
                        this.isWithinRange = this.distance <= this.maxDistance;

                        // Calcula o custo do frete
                        if (this.isWithinRange) {
                            this.shippingCost = Math.ceil(this.distance) * this.pricePerKm;
                        } else {
                            this.shippingCost = 0;
                        }
                    },

                    toRad(deg) {
                        return deg * (Math.PI / 180);
                    },

                    selectSavedAddress(index) {
                        const address = this.savedAddresses[index];
                        if (address.lat && address.lng) {
                            this.setDeliveryLocation(address.lat, address.lng);

                            // Centraliza o mapa no endereço
                            if (this.map) {
                                this.map.setView([address.lat, address.lng], 14);
                            }
                        }
                    },

                    async searchCep() {
                        const cep = this.newAddress.zipcode.replace(/\D/g, '');
                        if (cep.length !== 8) return;

                        try {
                            const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                            const data = await response.json();

                            if (!data.erro) {
                                this.newAddress.street = data.logradouro || '';
                                this.newAddress.neighborhood = data.bairro || '';
                                this.newAddress.city = data.localidade || '';
                                this.newAddress.state = data.uf || '';

                                // Busca coordenadas pelo endereço (usando Nominatim)
                                this.geocodeAddress();
                            }
                        } catch (error) {
                            console.error('Erro ao buscar CEP:', error);
                        }
                    },

                    async geocodeAddress() {
                        const query = `${this.newAddress.street}, ${this.newAddress.city}, ${this.newAddress.state}, Brasil`;
                        try {
                            const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`);
                            const data = await response.json();

                            if (data.length > 0) {
                                this.newAddress.lat = parseFloat(data[0].lat);
                                this.newAddress.lng = parseFloat(data[0].lon);
                            }
                        } catch (error) {
                            console.error('Erro ao geocodificar:', error);
                        }
                    },

                    async saveNewAddress() {
                        // Validação básica
                        if (!this.newAddress.label || !this.newAddress.street || !this.newAddress.number || !this.newAddress.city) {
                            window.showNotification ?
                                window.showNotification('Por favor, preencha todos os campos obrigatórios.', 'error') :
                                alert('Por favor, preencha todos os campos obrigatórios.');
                            return;
                        }

                        this.isLoading = true;

                        try {
                            const response = await fetch('{{ route('account.addresses.store') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: JSON.stringify({
                                    label: this.newAddress.label,
                                    zipcode: this.newAddress.zipcode,
                                    street: this.newAddress.street,
                                    number: this.newAddress.number,
                                    complement: this.newAddress.complement,
                                    neighborhood: this.newAddress.neighborhood,
                                    city: this.newAddress.city,
                                    state: this.newAddress.state,
                                    latitude: this.newAddress.lat,
                                    longitude: this.newAddress.lng,
                                    is_default: this.newAddress.isDefault
                                })
                            });

                            const data = await response.json();

                            if (data.success) {
                                // Adiciona o novo endereço à lista
                                const newAddr = {
                                    id: data.address.id,
                                    label: data.address.label,
                                    street: data.address.street,
                                    number: data.address.number,
                                    complement: data.address.complement,
                                    neighborhood: data.address.neighborhood,
                                    city: data.address.city,
                                    state: data.address.state,
                                    zipcode: data.address.zipcode,
                                    lat: parseFloat(data.address.latitude) || null,
                                    lng: parseFloat(data.address.longitude) || null,
                                    isDefault: data.address.is_default
                                };

                                // Se for padrão, remove o padrão dos outros
                                if (newAddr.isDefault) {
                                    this.savedAddresses.forEach(addr => addr.isDefault = false);
                                }

                                this.savedAddresses.push(newAddr);

                                // Reseta o formulário
                                this.resetNewAddress();
                                this.showNewAddressForm = false;

                                // Seleciona o novo endereço
                                this.selectedAddressIndex = this.savedAddresses.length - 1;
                                this.selectSavedAddress(this.selectedAddressIndex);

                                window.showNotification ?
                                    window.showNotification('Endereço salvo com sucesso!', 'success') :
                                    alert('Endereço salvo com sucesso!');
                            } else {
                                throw new Error(data.message || 'Erro ao salvar endereço');
                            }
                        } catch (error) {
                            console.error('Erro ao salvar endereço:', error);
                            window.showNotification ?
                                window.showNotification('Erro ao salvar endereço. Tente novamente.', 'error') :
                                alert('Erro ao salvar endereço. Tente novamente.');
                        } finally {
                            this.isLoading = false;
                        }
                    },

                    resetNewAddress() {
                        this.newAddress = {
                            label: '',
                            street: '',
                            number: '',
                            complement: '',
                            neighborhood: '',
                            city: '',
                            state: '',
                            zipcode: '',
                            lat: null,
                            lng: null,
                            isDefault: false
                        };
                    },

                    async removeAddress(index) {
                        const address = this.savedAddresses[index];

                        if (!confirm('Deseja realmente remover este endereço?')) {
                            return;
                        }

                        this.isLoading = true;

                        try {
                            let url = `{{ route('account.addresses.destroy', ':id') }}`;
                            url = url.replace(':id', address.id);
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
                                this.savedAddresses.splice(index, 1);

                                if (this.selectedAddressIndex === index) {
                                    this.selectedAddressIndex = null;
                                    this.distance = 0;
                                    this.shippingCost = 0;

                                    // Remove marcador do mapa
                                    if (this.deliveryMarker) {
                                        this.map.removeLayer(this.deliveryMarker);
                                        this.deliveryMarker = null;
                                    }
                                    if (this.routeLine) {
                                        this.map.removeLayer(this.routeLine);
                                        this.routeLine = null;
                                    }
                                } else if (this.selectedAddressIndex > index) {
                                    this.selectedAddressIndex--;
                                }

                                window.showNotification ?
                                    window.showNotification('Endereço removido com sucesso!', 'success') :
                                    alert('Endereço removido com sucesso!');
                            } else {
                                throw new Error(data.message || 'Erro ao remover endereço');
                            }
                        } catch (error) {
                            console.error('Erro ao remover endereço:', error);
                            window.showNotification ?
                                window.showNotification('Erro ao remover endereço. Tente novamente.', 'error') :
                                alert('Erro ao remover endereço. Tente novamente.');
                        } finally {
                            this.isLoading = false;
                        }
                    }
                };
            }
        </script>
    @endpush
</x-frontend.layout>
