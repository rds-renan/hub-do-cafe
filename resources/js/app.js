import '@fontsource/material-icons';
import './bootstrap';
import Alpine from 'alpinejs';

import.meta.glob([
   '../images/**',
]);

window.Alpine = Alpine;
Alpine.start();

// Previne o envio padrão dos formulários de adicionar ao carrinho
document.addEventListener('submit', async function(e) {
    // Verifica se o formulário tem a classe add-to-cart-form
    if (!e.target.classList.contains('add-to-cart-form')) {
        return; // Se não for o formulário correto, deixa seguir normalmente
    }

    e.preventDefault(); // Impede o recarregamento

    const form = e.target;
    const formData = new FormData(form);
    const action = form.getAttribute('action');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
        const response = await fetch(action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: formData
        });

        const data = await response.json();

        if (data.cartCount !== undefined) {
            updateCartBadge(data.cartCount);
        }
    } catch (error) {
        console.error('Erro:', error);
    }
});

// Atualiza o badge do carrinho
function updateCartBadge(count) {
    const badge = document.getElementById('cart-count-badge');
    if (badge) {
        badge.textContent = count;
        badge.style.display = count > 0 ? 'flex' : 'none';
    }
}

// Atualiza o badge ao carregar a página
document.addEventListener('DOMContentLoaded', function() {
    const cartCount = document.body.dataset.cartCount || 0;
    updateCartBadge(cartCount);
});
