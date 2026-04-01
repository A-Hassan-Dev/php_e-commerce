<?php
session_start();

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Helper to read products
function getProducts() {
    $json = file_get_contents(__DIR__ . '/../data/products.json');
    $data = json_decode($json, true);
    return $data['products'] ?? [];
}

function getProductById($productId) {
    $products = getProducts();
    foreach ($products as $p) {
        if ($p['id'] == $productId) {
            return $p;
        }
    }
    return null;
}

function addToCart($productId, $quantity) {
    $product = getProductById($productId);
    if (!$product || $product['stock'] <= 0) {
        return false;
    }
    
    // Check if item is already in cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $productId) {
            $item['quantity'] += $quantity;
            // Cap at 10 or stock limit
            if ($item['quantity'] > 10) $item['quantity'] = 10;
            if ($item['quantity'] > $product['stock']) $item['quantity'] = $product['stock'];
            $found = true;
            break;
        }
    }
    
    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $productId,
            'quantity' => min($quantity, 10, $product['stock'])
        ];
    }
    
    return true;
}

function removeFromCart($productId) {
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $productId) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index array
            return true;
        }
    }
    return false;
}

function updateCartQty($productId, $qty) {
    $product = getProductById($productId);
    if (!$product) return false;
    
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $productId) {
            $item['quantity'] = max(1, min($qty, 10, $product['stock']));
            return true;
        }
    }
    return false;
}

function getCartItems() {
    $items = [];
    foreach ($_SESSION['cart'] as $cartItem) {
        $product = getProductById($cartItem['id']);
        if ($product) {
            $product['cart_quantity'] = $cartItem['quantity'];
            $items[] = $product;
        }
    }
    return $items;
}

function getCartSubtotal() {
    $total = 0;
    foreach (getCartItems() as $item) {
        $total += $item['price'] * $item['cart_quantity'];
    }
    return $total;
}

function getCartTotal() {
    $subtotal = getCartSubtotal();
    if ($subtotal == 0) return 0;
    
    $shipping = $subtotal > 50 ? 0 : 5.99;
    $tax = $subtotal * 0.10;
    
    return $subtotal + $shipping + $tax;
}

function getCartCount() {
    $count = 0;
    foreach ($_SESSION['cart'] as $item) {
        $count += $item['quantity'];
    }
    return $count;
}
