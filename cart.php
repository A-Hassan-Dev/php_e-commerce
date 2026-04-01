<?php
require_once __DIR__ . '/includes/cart-handler.php';
require_once __DIR__ . '/includes/header.php';

$cartItems = getCartItems();
$subtotal = getCartSubtotal();
$shipping = ($subtotal > 50 || $subtotal == 0) ? 0 : 5.99;
$tax = $subtotal * 0.10;
$total = $subtotal + $shipping + $tax;
?>

<div class="bg-gray-50 border-b border-gray-100 py-3">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-heading font-bold text-gray-900">Your Shopping Cart</h1>
    </div>
</div>

<section class="py-12 bg-light flex-grow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if (empty($cartItems)): ?>
            <!-- Empty Cart State -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center max-w-2xl mx-auto">
                <div class="w-32 h-32 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-16 h-16 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h2 class="text-2xl font-heading font-bold text-gray-900 mb-2">Your cart is empty</h2>
                <p class="text-gray-500 mb-8">Looks like you haven't added anything to your cart yet. Discover our amazing products!</p>
                <a href="products.php" class="inline-block bg-primary hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition-colors shadow-md">Start Shopping</a>
            </div>
        <?php else: ?>
            <!-- Populated Cart -->
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items List -->
                <div class="w-full lg:w-2/3 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-100 text-gray-600 uppercase text-xs font-semibold tracking-wider">
                                    <th class="p-4" colspan="2">Product</th>
                                    <th class="p-4 hidden md:table-cell">Price</th>
                                    <th class="p-4 text-center">Quantity</th>
                                    <th class="p-4 text-right">Subtotal</th>
                                    <th class="p-4 text-center w-16"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach ($cartItems as $item): ?>
                                <tr id="cart-item-<?= $item['id'] ?>" class="group">
                                    <td class="p-4 w-24">
                                        <a href="product-detail.php?id=<?= $item['id'] ?>" class="block rounded-lg overflow-hidden border border-gray-100 bg-gray-50">
                                            <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="w-20 h-20 object-cover mix-blend-multiply">
                                        </a>
                                    </td>
                                    <td class="p-4 align-top pt-5">
                                        <a href="product-detail.php?id=<?= $item['id'] ?>" class="font-heading font-semibold text-gray-900 hover:text-primary transition-colors text-sm sm:text-base line-clamp-2 mb-1">
                                            <?= htmlspecialchars($item['name']) ?>
                                        </a>
                                        <div class="text-xs text-gray-500 uppercase font-medium tracking-wide"><?= htmlspecialchars($item['category']) ?></div>
                                        <div class="text-gray-900 font-bold mt-2 md:hidden">$<?= number_format($item['price'], 2) ?></div>
                                    </td>
                                    <td class="p-4 font-bold text-gray-900 hidden md:table-cell align-top pt-5">
                                        $<?= number_format($item['price'], 2) ?>
                                    </td>
                                    <td class="p-4 align-top pt-4">
                                        <div class="flex items-center justify-center bg-gray-50 border border-gray-200 rounded-lg overflow-hidden w-28 mx-auto">
                                            <button type="button" onclick="updateQuantity(<?= $item['id'] ?>, <?= $item['cart_quantity'] - 1 ?>, document.getElementById('qty-<?= $item['id'] ?>'))" class="px-3 py-1.5 text-gray-500 hover:text-gray-800 hover:bg-gray-200 transition-colors" <?= $item['cart_quantity'] <= 1 ? 'disabled' : '' ?>>-</button>
                                            <input type="number" id="qty-<?= $item['id'] ?>" value="<?= $item['cart_quantity'] ?>" readonly class="w-full text-center bg-transparent border-none text-gray-900 font-medium focus:ring-0 p-0 text-sm">
                                            <button type="button" onclick="updateQuantity(<?= $item['id'] ?>, <?= $item['cart_quantity'] + 1 ?>, document.getElementById('qty-<?= $item['id'] ?>'))" class="px-3 py-1.5 text-gray-500 hover:text-gray-800 hover:bg-gray-200 transition-colors" <?= $item['cart_quantity'] >= min(10, $item['stock']) ? 'disabled' : '' ?>>+</button>
                                        </div>
                                        <?php if ($item['stock'] < 5): ?>
                                            <div class="text-xs text-orange-500 text-center mt-2 font-medium">Only <?= $item['stock'] ?> left</div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="p-4 text-right font-bold text-gray-900 align-top pt-5 text-sm sm:text-base" id="item-subtotal-<?= $item['id'] ?>">
                                        $<?= number_format($item['price'] * $item['cart_quantity'], 2) ?>
                                    </td>
                                    <td class="p-4 align-top pt-4 text-center">
                                        <button onclick="removeFromCart(<?= $item['id'] ?>, document.getElementById('cart-item-<?= $item['id'] ?>'))" class="text-gray-300 hover:text-red-500 transition-colors p-2 rounded-full hover:bg-red-50" aria-label="Remove item">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="bg-gray-50 p-4 border-t border-gray-100 flex justify-between items-center sm:hidden">
                        <span class="font-semibold text-gray-700">Cart Total Items:</span>
                        <span class="font-bold text-gray-900 cart-count-badge"><?= getCartCount() ?></span>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-24">
                        <h2 class="text-xl font-heading font-bold text-gray-900 mb-6 border-b border-gray-100 pb-4">Order Summary</h2>
                        
                        <div class="space-y-4 text-sm text-gray-600 mb-6">
                            <div class="flex justify-between">
                                <span>Subtotal</span>
                                <span class="font-bold text-gray-900" id="cart-subtotal">$<?= number_format($subtotal, 2) ?></span>
                            </div>
                            <div class="flex justify-between border-b border-dashed border-gray-200 pb-4">
                                <span class="flex items-center">
                                    Shipping
                                    <svg class="w-4 h-4 ml-1 text-gray-400 cursor-help" fill="none" stroke="currentColor" viewBox="0 0 24 24" title="Free shipping on orders over $50"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </span>
                                <span class="font-bold text-gray-900" id="cart-shipping"><?= $shipping == 0 ? 'Free' : '$' . number_format($shipping, 2) ?></span>
                            </div>
                            <div class="flex justify-between pt-2">
                                <span>Tax (10%)</span>
                                <span class="font-bold text-gray-900" id="cart-tax">$<?= number_format($tax, 2) ?></span>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center bg-gray-50 p-4 rounded-lg border border-gray-100 mb-6">
                            <span class="text-lg font-heading font-bold text-gray-900">Total</span>
                            <span class="text-2xl font-bold text-primary" id="cart-total">$<?= number_format($total, 2) ?></span>
                        </div>
                        
                        <a href="checkout.php" class="w-full block text-center bg-primary hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition-all mb-4">
                            Proceed to Checkout
                        </a>
                        
                        <a href="products.php" class="w-full block text-center bg-white border-2 border-primary text-primary hover:bg-blue-50 font-semibold py-2.5 px-4 rounded-lg transition-colors">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
