<footer class="bg-white mt-20">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-24">
            <!-- Logo e Descrição -->
            <div class="space-y-6 gap-3">
                <img src="{{ asset('images/logo/logo_horizontal.svg') }}" alt="Hub do Café" class="h-10 mb-4">
                <p class="text-sm">
                    O sabor do café especial, agora na sua casa. Peça online para tele-entrega (raio de 10km) ou retirada na loja.
                </p>
                <p class="text-sm">
                    Apaixonados por café, da seleção do grão à sua xícara. Conheça nosso cardápio e viva essa experiência.
                </p>
                <p class="font-semibold text-lg">
                    Café gourmet. Feito para você. Peça online.
                </p>
            </div>

            <!-- Links Rápidos -->
            <div class="md:ml-14">
                <h3 class="font-semibold mb-4">Links Rápidos</h3>
                <ul class="space-y-6 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-gray-600 transition">Cardápio</a></li>
                    <li><a href="#" class="hover:text-gray-600 transition">Como pedir</a></li>
                    <li><a href="#" class="hover:text-gray-600 transition">Sobre nós</a></li>
                    <li><a href="#" class="hover:text-gray-600 transition">Perguntas frequentes</a></li>
                    <li><a href="#" class="hover:text-gray-600 transition">Entre em contato</a></li>
                </ul>
            </div>

            <!-- Redes Sociais -->
            <div>
                <h3 class="font-semibold mb-4">Siga-nos</h3>
                <div class="space-y-2">
                    <x-frontend.social-icon network="facebook">
                        Facebook
                    </x-frontend.social-icon>
                    <x-frontend.social-icon network="instagram">
                        Instagram
                    </x-frontend.social-icon>
                    <x-frontend.social-icon network="x">
                        Twitter
                    </x-frontend.social-icon>
                    <x-frontend.social-icon network="linkedin">
                        Linkedin
                    </x-frontend.social-icon>
                    <x-frontend.social-icon network="youtube">
                        Youtube
                    </x-frontend.social-icon>
                </div>
            </div>
        </div>

        <div class="border-t border-amber-600 mt-12 pt-8 text-center text-gray-600 text-sm">
            <p>Projeto fictício desenvolvido para fins acadêmicos. Sem fins lucrativos.</p>
        </div>
    </div>
</footer>
