<?php
require_once __DIR__ . '/includes/cart-handler.php';

// Prevent accessing via URL directly if no order in session
if (!isset($_SESSION['last_order'])) {
    header("Location: index.php");
    exit;
}

$order = $_SESSION['last_order'];
// Unset so refreshing clears the page
unset($_SESSION['last_order']);

require_once __DIR__ . '/includes/header.php';
?>

<section class="py-16 bg-light flex-grow flex items-center justify-center">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 sm:p-12 text-center">
            
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
            </div>
            
            <h1 class="text-3xl font-heading font-bold text-gray-900 mb-2">Order Placed Successfully!</h1>
            <p class="text-lg text-gray-600 mb-8">Thank you for your purchase. We've received your order and will begin processing it right away.</p>
            
            <div class="bg-gray-50 rounded-xl p-6 text-left mb-8 border border-gray-100 relative overflow-hidden">
                <!-- Decorative pattern -->
                <div class="absolute top-0 right-0 -mr-4 -mt-4 w-24 h-24 bg-blue-50 rounded-full opacity-50"></div>
                
                <h3 class="font-heading font-bold text-gray-900 text-lg mb-4 relative z-10">Order Summary</h3>
                
                <div class="grid grid-cols-2 gap-4 text-sm text-gray-600 mb-6 relative z-10 border-b border-gray-200 pb-4">
                    <div>
                        <span class="block text-gray-400 font-medium">Order Reference:</span>
                        <span class="font-bold text-gray-900 tracking-wider"><?= htmlspecialchars($order['id']) ?></span>
                    </div>
                    <div>
                        <span class="block text-gray-400 font-medium">Date:</span>
                        <span class="font-bold text-gray-900"><?= date('F j, Y', strtotime($order['date'])) ?></span>
                    </div>
                    <div>
                        <span class="block text-gray-400 font-medium">Payment Method:</span>
                        <span class="font-bold text-gray-900">Demo Checkout</span>
                    </div>
                    <div>
                        <span class="block text-gray-400 font-medium">Status:</span>
                        <span class="font-bold text-green-600 flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span> Confirmed
                        </span>
                    </div>
                </div>

                <div class="space-y-3 relative z-10">
                    <?php foreach ($order['items'] as $item): ?>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-700">
                            <span class="font-semibold text-gray-900"><?= $item['cart_quantity'] ?>x</span> 
                            <?= htmlspecialchars($item['name']) ?>
                        </span>
                        <span class="font-medium text-gray-900">$<?= number_format($item['price'] * $item['cart_quantity'], 2) ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-200 flex justify-between items-center relative z-10">
                    <span class="font-bold text-gray-900 uppercase tracking-wider text-sm">Total Paid</span>
                    <span class="text-2xl font-bold text-primary">$<?= number_format($order['total'], 2) ?></span>
                </div>
            </div>
            
            <a href="index.php" class="inline-block bg-primary hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg shadow-md transition-colors w-full sm:w-auto">
                Continue Shopping
            </a>
            
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
