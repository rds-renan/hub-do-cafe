import '@fontsource/material-icons';
import './bootstrap';
import Alpine from 'alpinejs';

import.meta.glob([
   '../images/**',
]);

window.Alpine = Alpine;
Alpine.start();

function updateCartBadge(count) {
    const badge = document.querySelector('#cart-count-badge') ||
        document.querySelector('.cart-badge') ||
        document.querySelector('[data-cart-badge]') ||
        document.querySelector('.badge');

    if (badge) {
        badge.textContent = count;

        // Mostra/esconde o badge se count for 0
        if (count > 0) {
            badge.classList.remove('hidden');
        } else {
            badge.classList.add('hidden');
        }

        // Adiciona animação de "pulse" ao atualizar
        badge.classList.add('animate-pulse');
        setTimeout(() => badge.classList.remove('animate-pulse'), 500);
    } else {
        console.error('Badge do carrinho não encontrado! Verifique se o elemento #cart-count-badge existe no HTML');
    }

    // Também atualiza outros elementos que mostram a contagem
    const cartCountElements = document.querySelectorAll('[data-cart-count]');
    cartCountElements.forEach(el => {
        el.textContent = count;
    });
}

// Função para mostrar notificações
function showNotification(message, type = 'success') {
    // Remove notificação anterior se existir
    const existingNotification = document.querySelector('.notification');
    if (existingNotification) {
        existingNotification.remove();
    }

    // Cria a notificação
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div style="
            position: fixed;
            top: 70px;
            right: 20px;
            background: ${type === 'success' ? '#461901' : '#ef4444'};
            color: white;
            padding: 16px 24px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            z-index: 9999;
            animation: slideIn 0.3s ease-out;
        ">
            <strong>${message}</strong>
        </div>
    `;

    // Adiciona animação CSS
    if (!document.querySelector('#notification-styles')) {
        const style = document.createElement('style');
        style.id = 'notification-styles';
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(400px); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            .animate-pulse {
                animation: pulse 0.5s ease-in-out;
            }
            @keyframes pulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.2); }
            }
        `;
        document.head.appendChild(style);
    }

    document.body.appendChild(notification);

    // Remove após 3 segundos
    setTimeout(() => {
        notification.style.animation = 'slideIn 0.3s ease-out reverse';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Função principal para adicionar ao carrinho
async function addToCart(form) {
    const action = form.action;
    const formData = new FormData(form);
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    // Validação do token CSRF
    if (!csrfToken) {
        showNotification('Erro de segurança. Recarregue a página.', 'error');
        return;
    }

    // Desabilita o botão de submit durante o processo
    const submitButton = form.querySelector('button[type="submit"]');
    const originalButtonText = submitButton?.innerHTML;

    if (submitButton) {
        submitButton.disabled = true;
        submitButton.innerHTML = '<span>Adicionando...</span>';
    }

    try {
        const response = await fetch(action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        });

        // Verifica se a resposta é OK
        if (!response.ok) {
            throw new Error(`Erro HTTP: ${response.status}`);
        }

        const data = await response.json();

        if (data.success) {
            // Atualiza o badge do carrinho
            if (data.cartCount !== undefined) {
                updateCartBadge(data.cartCount);
            } else {
                console.warn('cartCount não está definido na resposta!');
            }

            // Mostra notificação de sucesso
            showNotification(data.message || 'Produto adicionado ao carrinho!', 'success');

            // Atualiza o total se disponível
            if (data.cartTotal !== undefined) {
                const totalElement = document.querySelector('.cart-total');
                if (totalElement) {
                    totalElement.textContent = data.cartFormatted?.total || `R$ ${data.cartTotal.toFixed(2).replace('.', ',')}`;
                }
            }
        } else {
            // Erro retornado pelo servidor
            showNotification(data.message || 'Erro ao adicionar produto', 'error');
        }

    } catch (error) {
        console.error('Erro ao adicionar ao carrinho:', error);
        showNotification('Erro ao adicionar produto. Tente novamente.', 'error');
    } finally {
        // Re-habilita o botão
        if (submitButton) {
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;
        }
    }
}

// Event listener para formulários de adicionar ao carrinho
document.addEventListener('DOMContentLoaded', function() {
    const addToCartForms = document.querySelectorAll('.add-to-cart-form');

    addToCartForms.forEach((form, index) => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault(); // IMPEDE O ENVIO TRADICIONAL
            e.stopPropagation(); // PARA A PROPAGAÇÃO DO EVENTO

            await addToCart(this);

            return false; // GARANTE QUE NÃO VAI RECARREGAR
        });
    });

    // Também captura clicks diretos nos botões (fallback)
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn, button[data-add-to-cart]');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            e.stopPropagation();

            const form = this.closest('form');
            if (form) {
                await addToCart(form);
            }

            return false;
        });
    });
});

// Exporta as funções caso precise usar em outros lugares
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { addToCart, updateCartBadge, showNotification };
}
