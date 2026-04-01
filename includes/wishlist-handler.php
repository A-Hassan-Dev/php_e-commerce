<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize wishlist if not exists
if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = [];
}

/**
 * Toggle abstract product in wishlist
 * @param int $productId
 * @return array ['success' => true, 'is_wishlisted' => bool, 'wishlistCount' => int]
 */
function toggleWishlist($productId) {
    $productId = (int)$productId;
    $isWishlisted = false;
    
    if (in_array($productId, $_SESSION['wishlist'])) {
        // Remove
        $_SESSION['wishlist'] = array_diff($_SESSION['wishlist'], [$productId]);
    } else {
        // Add
        $_SESSION['wishlist'][] = $productId;
        $isWishlisted = true;
    }
    
    // re-index
    $_SESSION['wishlist'] = array_values($_SESSION['wishlist']);
    
    return [
        'success' => true,
        'is_wishlisted' => $isWishlisted,
        'wishlistCount' => count($_SESSION['wishlist'])
    ];
}

/**
 * Check if a product is in wishlist
 */
function inWishlist($productId) {
    $productId = (int)$productId;
    return in_array($productId, $_SESSION['wishlist']);
}

/**
 * Get total items in wishlist
 */
function getWishlistCount() {
    return count($_SESSION['wishlist']);
}
