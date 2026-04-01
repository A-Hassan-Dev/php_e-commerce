// Cart interactions

function addToCart(productId, quantity = 1) {
    fetch('api/add-to-cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ product_id: productId, quantity: quantity })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            updateCartBadge(data.cartCount);
        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(err => {
        console.error('Error adding to cart:', err);
        showToast('An error occurred. Please try again.', 'error');
    });
}

function updateQuantity(productId, newQty, inputEl) {
    if (newQty < 1 || newQty > 10) return;
    
    // Update input immediately for responsiveness
    if (inputEl) inputEl.value = newQty;

    fetch('api/update-cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ product_id: productId, quantity: newQty })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCartBadge(data.cartCount);
            
            // Update the DOM if we are on the cart page
            const itemSubtotalEl = document.getElementById(`item-subtotal-${productId}`);
            if (itemSubtotalEl) itemSubtotalEl.textContent = '$' + data.itemSubtotal;

            const cartSubtotalEl = document.getElementById('cart-subtotal');
            if (cartSubtotalEl) cartSubtotalEl.textContent = '$' + data.newSubtotal;

            const cartShippingEl = document.getElementById('cart-shipping');
            if (cartShippingEl) cartShippingEl.textContent = data.shipping;

            const cartTaxEl = document.getElementById('cart-tax');
            if (cartTaxEl) cartTaxEl.textContent = data.tax;

            const cartTotalEl = document.getElementById('cart-total');
            if (cartTotalEl) cartTotalEl.textContent = data.newTotal;

        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(err => {
        console.error('Error updating cart:', err);
        showToast('Failed to update cart.', 'error');
    });
}

function removeFromCart(productId, rowEl) {
    fetch('api/remove-from-cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('Item removed from cart.', 'info');
            updateCartBadge(data.cartCount);
            
            // Remove row from DOM
            if (rowEl) {
                rowEl.remove();
            }

            // Check if cart is abstractly empty now
            if (data.cartCount === 0) {
                location.reload(); // Reload to show empty cart message
                return;
            }

            // Update totals
            const cartSubtotalEl = document.getElementById('cart-subtotal');
            if (cartSubtotalEl) cartSubtotalEl.textContent = '$' + data.newSubtotal;

            const cartShippingEl = document.getElementById('cart-shipping');
            if (cartShippingEl) cartShippingEl.textContent = data.shipping;

            const cartTaxEl = document.getElementById('cart-tax');
            if (cartTaxEl) cartTaxEl.textContent = data.tax;

            const cartTotalEl = document.getElementById('cart-total');
            if (cartTotalEl) cartTotalEl.textContent = data.newTotal;

        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(err => {
        console.error('Error removing from cart:', err);
        showToast('Failed to remove item.', 'error');
    });
}
