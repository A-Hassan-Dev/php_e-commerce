// Wishlist interactions

function toggleWishlist(productId, btnEl) {
    fetch('api/toggle-wishlist.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            updateWishlistBadge(data.wishlistCount);
            
            // Toggle the heart appearance if btnEl is provided
            if (btnEl) {
                const svg = btnEl.querySelector('svg');
                if (data.is_wishlisted) {
                    // Make it solid red
                    svg.setAttribute('fill', 'currentColor');
                    svg.classList.add('text-red-500');
                    svg.classList.remove('text-gray-400');
                    btnEl.classList.add('ring-2', 'ring-red-200');
                } else {
                    // Make it outline
                    svg.setAttribute('fill', 'none');
                    svg.classList.remove('text-red-500');
                    svg.classList.add('text-gray-400');
                    btnEl.classList.remove('ring-2', 'ring-red-200');
                }
            } else {
                // If it's removed from the wishlist page directly
                if (!data.is_wishlisted) {
                     const itemRow = document.getElementById(`wishlist-item-${productId}`);
                     if (itemRow) {
                         itemRow.remove();
                     }
                     if (data.wishlistCount === 0) {
                         location.reload();
                     }
                }
            }
        } else {
            showToast(data.message, 'error');
        }
    })
    .catch(err => {
        console.error('Error toggling wishlist:', err);
        showToast('An error occurred.', 'error');
    });
}

function updateWishlistBadge(count) {
    const badges = document.querySelectorAll('.wishlist-count-badge');
    badges.forEach(badge => {
        badge.textContent = count;
        if (count > 0) {
            badge.classList.remove('hidden');
        } else {
            badge.classList.add('hidden');
        }
    });
}
