<?php
require_once __DIR__ . '/includes/cart-handler.php';

$cartItems = getCartItems();
if (empty($cartItems)) {
    header("Location: cart.php");
    exit;
}

$subtotal = getCartSubtotal();
$shipping = ($subtotal > 50 || $subtotal == 0) ? 0 : 5.99;
$tax = $subtotal * 0.10;
$total = $subtotal + $shipping + $tax;

$errors = [];

// Handle server-side submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $required = ['fullName', 'email', 'phone', 'address', 'city', 'postalCode', 'country'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            $errors[] = "Please fill in all required fields.";
            break;
        }
    }

    if (!filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address format.";
    }

    if (empty($errors)) {
        // Save order items to session for success page
        $_SESSION['last_order'] = [
            'id' => uniqid('ORD-', true),
            'items' => $cartItems,
            'total' => $total,
            'date' => date('Y-m-d H:i:s')
        ];
        
        // Clear active cart array
        $_SESSION['cart'] = [];
        
        header("Location: order-success.php");
        exit;
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<div class="bg-gray-50 border-b border-gray-100 py-3">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-heading font-bold text-gray-900">Secure Checkout</h1>
    </div>
</div>

<section class="py-12 bg-light flex-grow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <?php if (!empty($errors)): ?>
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-8 rounded-r-lg shadow-sm">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-semibold text-red-800">There were problems with your submission:</span>
                </div>
                <ul class="list-disc pl-12 mt-2 text-sm text-red-700">
                    <?php foreach ($errors as $e): ?>
                        <li><?= htmlspecialchars($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="flex flex-col-reverse lg:flex-row gap-8">
            <!-- Checkout Form (Left 60%) -->
            <div class="w-full lg:w-3/5">
                <form id="checkout-form" method="POST" action="checkout.php" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sm:p-8 shrink-0">
                    <h2 class="text-xl font-heading font-bold text-gray-900 mb-6 border-b border-gray-100 pb-4">Shipping Information</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="fullName" class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                            <input type="text" id="fullName" name="fullName" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary shadow-sm outline-none transition-colors" value="<?= htmlspecialchars($_POST['fullName'] ?? '') ?>">
                            <p class="error-msg hidden text-red-500 text-xs mt-1" id="fullName-error"></p>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                            <input type="email" id="email" name="email" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary shadow-sm outline-none transition-colors" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                            <p class="error-msg hidden text-red-500 text-xs mt-1" id="email-error"></p>
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary shadow-sm outline-none transition-colors" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                            <p class="error-msg hidden text-red-500 text-xs mt-1" id="phone-error"></p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Street Address *</label>
                        <input type="text" id="address" name="address" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary shadow-sm outline-none transition-colors" value="<?= htmlspecialchars($_POST['address'] ?? '') ?>">
                        <p class="error-msg hidden text-red-500 text-xs mt-1" id="address-error"></p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City *</label>
                            <input type="text" id="city" name="city" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary shadow-sm outline-none transition-colors" value="<?= htmlspecialchars($_POST['city'] ?? '') ?>">
                            <p class="error-msg hidden text-red-500 text-xs mt-1" id="city-error"></p>
                        </div>
                        <div>
                            <label for="postalCode" class="block text-sm font-medium text-gray-700 mb-1">Postal Code *</label>
                            <input type="text" id="postalCode" name="postalCode" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary shadow-sm outline-none transition-colors" value="<?= htmlspecialchars($_POST['postalCode'] ?? '') ?>">
                            <p class="error-msg hidden text-red-500 text-xs mt-1" id="postalCode-error"></p>
                        </div>
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country *</label>
                            <select id="country" name="country" class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary shadow-sm bg-white outline-none transition-colors">
                                <option value="">Select Country</option>
                                <option value="US" <?= ($_POST['country'] ?? '') == 'US' ? 'selected' : '' ?>>United States</option>
                                <option value="CA" <?= ($_POST['country'] ?? '') == 'CA' ? 'selected' : '' ?>>Canada</option>
                                <option value="UK" <?= ($_POST['country'] ?? '') == 'UK' ? 'selected' : '' ?>>United Kingdom</option>
                                <option value="AU" <?= ($_POST['country'] ?? '') == 'AU' ? 'selected' : '' ?>>Australia</option>
                                <option value="DE" <?= ($_POST['country'] ?? '') == 'DE' ? 'selected' : '' ?>>Germany</option>
                            </select>
                            <p class="error-msg hidden text-red-500 text-xs mt-1" id="country-error"></p>
                        </div>
                    </div>

                    <h2 class="text-xl font-heading font-bold text-gray-900 mb-4 border-b border-gray-100 pb-4">Payment Information</h2>
                    <div class="bg-blue-50 text-blue-800 p-4 rounded-lg mb-8 text-sm flex items-start">
                        <svg class="w-5 h-5 text-primary mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span><strong>Demo Note:</strong> No real payment is processed. You do not need to enter credit card details. Completing checkout will generate a fake order receipt.</span>
                    </div>

                    <button type="submit" class="w-full bg-gray-900 hover:bg-black text-white font-bold py-4 px-8 rounded-lg shadow font-heading tracking-wide transition-colors">
                        Place Order • $<?= number_format($total, 2) ?>
                    </button>
                    <p class="text-center text-xs text-gray-500 mt-4 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        Secure 256-bit SSL Encryption
                    </p>
                </form>
            </div>

            <!-- Order Summary (Right 40%) -->
            <div class="w-full lg:w-2/5">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-24">
                    <h2 class="text-lg font-heading font-bold text-gray-900 mb-4 pb-4 border-b border-gray-100">Order Contents (<?= getCartCount() ?>)</h2>
                    
                    <div class="space-y-4 max-h-80 overflow-y-auto pr-2 mb-6 custom-scrollbar">
                        <?php foreach ($cartItems as $item): ?>
                        <div class="flex gap-4">
                            <div class="relative flex-shrink-0">
                                <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="w-16 h-16 object-cover rounded-md border border-gray-200">
                                <span class="absolute -top-2 -right-2 bg-gray-600 text-white text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center"><?= $item['cart_quantity'] ?></span>
                            </div>
                            <div class="flex-grow">
                                <h4 class="text-sm font-semibold text-gray-900 line-clamp-2 leading-tight"><?= htmlspecialchars($item['name']) ?></h4>
                                <p class="text-sm font-bold text-gray-600 mt-1">$<?= number_format($item['price'], 2) ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="border-t border-gray-200 pt-4 space-y-3 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span class="font-bold text-gray-900">$<?= number_format($subtotal, 2) ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span>Shipping</span>
                            <span class="font-bold text-gray-900"><?= $shipping == 0 ? 'Free' : '$' . number_format($shipping, 2) ?></span>
                        </div>
                        <div class="flex justify-between border-b border-gray-200 pb-4">
                            <span>Estimated Tax</span>
                            <span class="font-bold text-gray-900">$<?= number_format($tax, 2) ?></span>
                        </div>
                        <div class="flex justify-between pt-2 items-center">
                            <span class="text-gray-900 font-bold">Total</span>
                            <span class="text-2xl font-bold text-gray-900">$<?= number_format($total, 2) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
