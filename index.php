<?php
require_once __DIR__ . '/includes/cart-handler.php';
require_once __DIR__ . '/includes/header.php';

$allProducts = getProducts();
$featuredProducts = array_filter($allProducts, function ($p) {
    return isset($p['featured']) && $p['featured'] == true;
});
// Limit to 8
$featuredProducts = array_slice($featuredProducts, 0, 8);
?>

<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-blue-900 to-primary text-white overflow-hidden py-20 lg:py-32">
    <div class="absolute inset-0 opacity-20">
        <svg class="h-full w-full object-cover" viewBox="0 0 100 100" preserveAspectRatio="none">
            <polygon fill="currentColor" points="0,100 100,0 100,100" />
        </svg>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center text-center">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-extrabold tracking-tight mb-6 animate-fade-in-up">
            Discover Amazing Products
        </h1>
        <p class="text-lg md:text-xl max-w-2xl text-blue-100 mb-10">
            Shop the latest trends in electronics, home goods, clothing, and accessories with free shipping on orders
            over $50.
        </p>
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="products.php"
                class="bg-accent hover:bg-orange-600 text-white px-8 py-3 rounded-md font-semibold text-lg transition-colors duration-200">Shop
                Now</a>
            <a href="about.php"
                class="bg-white text-primary hover:bg-gray-100 px-8 py-3 rounded-md font-semibold text-lg transition-colors duration-200">Learn
                More</a>
        </div>
    </div>
</section>

<!-- Trust Badges -->
<section class="py-10 bg-white shadow-sm border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="flex flex-col items-center">
                <div class="bg-blue-50 p-3 rounded-full mb-3 text-primary">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800">Secure Payment</h3>
                <p class="text-sm text-gray-500">100% secure checkout</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="bg-blue-50 p-3 rounded-full mb-3 text-primary">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800">Free Returns</h3>
                <p class="text-sm text-gray-500">30 days return policy</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="bg-blue-50 p-3 rounded-full mb-3 text-primary">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800">24/7 Support</h3>
                <p class="text-sm text-gray-500">Dedicated help center</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="bg-blue-50 p-3 rounded-full mb-3 text-primary">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800">Fast Delivery</h3>
                <p class="text-sm text-gray-500">Lightning-fast shipping</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-16 bg-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-heading font-bold text-gray-900 mb-8 text-center">Featured Products</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($featuredProducts as $product): ?>
                <div
                    class="product-card bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden flex flex-col h-full group transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative block bg-gray-50 aspect-[4/3] sm:aspect-square overflow-hidden group/image">
                        <a href="product-detail.php?id=<?= $product['id'] ?>" class="block w-full h-full relative">
                            <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" loading="lazy" class="w-full h-full object-cover group-hover/image:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-black/30 opacity-0 group-hover/image:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px] z-10">
                                <span class="bg-white/95 text-gray-900 font-semibold py-2.5 px-6 rounded-full transform translate-y-4 group-hover/image:translate-y-0 transition-all duration-300 shadow-xl flex items-center gap-2 text-sm z-20">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    View Details
                                </span>
                            </div>
                        </a>

                        <?php if ($product['stock'] <= 0): ?>
                            <span
                                class="absolute top-4 left-4 bg-gray-900/90 text-white text-xs font-bold px-3 py-1.5 rounded-full backdrop-blur-sm">Out
                                of Stock</span>
                        <?php endif; ?>

                        <?php
                        $isW = inWishlist($product['id']);
                        $heartColorClass = $isW ? 'text-red-500 ring-2 ring-red-200' : 'text-gray-400';
                        $fillAction = $isW ? 'fill="currentColor"' : 'fill="none"';
                        ?>
                        <button onclick="toggleWishlist(<?= $product['id'] ?>, this)" class="absolute top-4 right-4 bg-white/95 p-2.5 rounded-full shadow-md hover:bg-white <?= $heartColorClass ?> hover:text-red-500 transition-all duration-200 backdrop-blur-sm z-30" aria-label="Toggle wishlist">
                            <svg class="w-5 h-5 <?= $isW ? 'text-red-500' : 'text-gray-400 group-hover:text-red-500' ?>" <?= $fillAction ?> stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </button>
                    </div>

                    <div class="p-5 flex flex-col flex-grow">
                        <div class="flex justify-between items-start mb-2 mt-1">
                            <span
                                class="text-xs font-bold uppercase tracking-widest text-primary/80"><?= htmlspecialchars($product['category']) ?></span>
                            <div class="flex items-center text-yellow-400 text-sm">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span
                                    class="ml-1 text-gray-600 font-medium"><?= number_format($product['rating'], 1) ?></span>
                            </div>
                        </div>
                        <a href="product-detail.php?id=<?= $product['id'] ?>"
                            class="text-lg font-heading font-semibold text-gray-900 leading-tight hover:text-primary mb-3 flex-grow line-clamp-2">
                            <?= htmlspecialchars($product['name']) ?>
                        </a>
                        <div class="mt-auto pt-4 flex items-center justify-between border-t border-gray-100">
                            <span class="text-xl font-bold text-gray-900">$<?= number_format($product['price'], 2) ?></span>

                            <?php if ($product['stock'] > 0): ?>
                            <button onclick="addToCart(<?= $product['id'] ?>)" class="bg-primary hover:bg-blue-700 text-white p-3 rounded-xl transition-all duration-200 shadow hover:shadow-lg active:scale-95 flex items-center justify-center group/btn" aria-label="Add to cart" title="Add to Cart">
                                <svg class="w-5 h-5 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </button>
                            <?php else: ?>
                            <button disabled class="bg-gray-100 text-gray-400 p-3 rounded-xl cursor-not-allowed border border-gray-200 flex items-center justify-center" aria-label="Out of stock">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-12">
            <a href="products.php" class="inline-flex items-center text-primary font-semibold hover:text-blue-700">
                View All Products
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                    </path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Promotional Banner -->
<section class="py-12 bg-accent text-white text-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-heading font-bold mb-4">Free Shipping on Orders Over $50</h2>
        <p class="text-lg text-orange-100 mb-6">Upgrade your lifestyle today and let us handle the shipping costs.</p>
        <a href="products.php"
            class="bg-white text-accent hover:bg-gray-100 px-6 py-2 rounded-md font-semibold text-lg transition-colors duration-200">Start
            Shopping</a>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>