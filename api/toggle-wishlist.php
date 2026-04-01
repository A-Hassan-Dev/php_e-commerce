<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/wishlist-handler.php';

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);
$productId = isset($input['product_id']) ? (int)$input['product_id'] : 0;

if ($productId <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid product.']);
    exit;
}

// Toggle wishlist
$result = toggleWishlist($productId);

$result['message'] = $result['is_wishlisted'] ? 'Added to Wishlist!' : 'Removed from Wishlist!';

echo json_encode($result);
