<?php
require_once __DIR__ . '/includes/cart-handler.php';
require_once __DIR__ . '/includes/wishlist-handler.php';
require_once __DIR__ . '/includes/header.php';

$allProducts = getProducts();
$wishlistItems = [];

foreach ($allProducts as $p) {
    if (inWishlist($p['id'])) {
        $wishlistItems[] = $p;
    }
}
?>

<div class="bg-white border-b border-gray-100 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-heading font-bold text-gray-900">Your Wishlist</h1>
        <p class="text-gray-500 mt-1">Saved items for later</p>
    </div>
</div>

<section class="py-12 bg-light flex-grow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if (empty($wishlistItems)): ?>
            <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100">
                <svg class="mx-auto h-20 w-20 text-gray-200 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <h3 class="text-2xl font-heading font-bold text-gray-900 mb-2">Your wishlist is empty</h3>
                <p class="text-gray-500 mb-6 max-w-md mx-auto">Explore our collection and click the heart icon to save
                    products you love.</p>
                <a href="products.php"
                    class="inline-block bg-primary hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                    Start Exploring
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php foreach ($wishlistItems as $product): ?>
                    <div id="wishlist-item-<?= $product['id'] ?>"
                        class="product-card bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden flex flex-col h-full group transition-all duration-300 transform hover:-translate-y-1">
                        <!-- Image Container with floating Wishlist button -->
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
                                    class="absolute top-4 left-4 bg-gray-900/90 text-white text-xs font-bold px-3 py-1.5 rounded-full backdrop-blur-sm z-20">Out
                                    of Stock</span>
                            <?php endif; ?>

                            <!-- Wishlist Toggle Button -->
                            <button onclick="toggleWishlist(<?= $product['id'] ?>, this)"
                                class="absolute top-4 right-4 bg-white/95 p-2.5 rounded-full shadow-md hover:bg-white text-red-500 ring-2 ring-red-200 transition-all duration-200 backdrop-blur-sm z-30"
                                aria-label="Toggle wishlist">
                                <svg class="w-5 h-5 text-red-500" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                    </path>
                                </svg>
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
                                    <button onclick="addToCart(<?= $product['id'] ?>)"
                                        class="bg-primary hover:bg-blue-700 text-white p-3 rounded-xl transition-all duration-200 shadow hover:shadow-lg active:scale-95 flex items-center justify-center group/btn"
                                        aria-label="Add to cart" title="Add to Cart">
                                        <svg class="w-5 h-5 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    </button>
                                <?php else: ?>
                                    <button disabled
                                        class="bg-gray-100 text-gray-400 p-3 rounded-xl cursor-not-allowed border border-gray-200 flex items-center justify-center"
                                        aria-label="Out of stock">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>