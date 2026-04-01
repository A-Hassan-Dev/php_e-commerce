<?php
header('Content-Type: application/json');
require_once '../includes/cart-handler.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['product_id']) || !isset($data['quantity'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$productId = (int)$data['product_id'];
$quantity = (int)$data['quantity'];

if ($quantity < 1) $quantity = 1;

$success = addToCart($productId, $quantity);

if ($success) {
    echo json_encode([
        'success' => true,
        'cartCount' => getCartCount(),
        'message' => 'Product added to cart!'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to add product (or out of stock).'
    ]);
}
