<?php
header('Content-Type: application/json');
require_once '../includes/cart-handler.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['product_id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$productId = (int)$data['product_id'];

$success = removeFromCart($productId);

if ($success) {
    $subtotal = getCartSubtotal();
    $shipping = $subtotal > 50 || $subtotal == 0 ? 0 : 5.99;
    $tax = $subtotal * 0.10;

    echo json_encode([
        'success' => true,
        'cartCount' => getCartCount(),
        'newSubtotal' => number_format($subtotal, 2),
        'shipping' => $shipping == 0 ? 'Free' : '$' . number_format($shipping, 2),
        'tax' => '$' . number_format($tax, 2),
        'newTotal' => '$' . number_format(getCartTotal(), 2)
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Product not found in cart.']);
}
