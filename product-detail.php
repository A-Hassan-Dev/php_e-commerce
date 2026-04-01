<?php
require_once __DIR__ . '/includes/header.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = null;

$products = getProducts();
foreach ($products as $p) {
    if ($p['id'] === $id) {
        $product = $p;
        break;
    }
}

if (!$product) {
    require_once __DIR__ . '/404.php';
    exit;
}

// Get related products (same category, exclude current)
$related = array_filter($products, function($p) use ($product) {
    return $p['category'] === $product['category'] && $p['id'] !== $product['id'];
});
// Limit to 4
$related = array_slice($related, 0, 4);
?>

<div class="bg-light py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex mb-8 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="index.php" class="text-gray-500 hover:text-primary transition-colors">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <a href="products.php" class="text-gray-500 hover:text-primary transition-colors">Products</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="text-gray-900 font-medium" aria-current="page"><?= htmlspecialchars($product['category']) ?></span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
                <!-- Product Image -->
                <div class="relative bg-gray-50 p-8 md:p-12 flex items-center justify-center border-b md:border-b-0 md:border-r border-gray-100 group/image">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="max-w-full h-auto object-contain max-h-[500px] hover:scale-105 transition-transform duration-500">
                    <?php if ($product['stock'] <= 0): ?>
                    <span class="absolute top-6 left-6 bg-gray-900/90 text-white text-sm font-bold px-4 py-2 rounded-full backdrop-blur-sm">Out of Stock</span>
                    <?php endif; ?>
                    
                    <?php 
                        $isW = inWishlist($product['id']); 
                        $heartClass = $isW ? 'text-red-500 ring-2 ring-red-200' : 'text-gray-400 hover:text-red-500';
                        $fillAction = $isW ? 'fill="currentColor"' : 'fill="none"';
                    ?>
                    <button onclick="toggleWishlist(<?= $product['id'] ?>, this)" class="absolute top-6 right-6 bg-white/95 p-3 rounded-full shadow-md <?= $heartClass ?> transition-all duration-200 backdrop-blur-sm z-30" aria-label="Toggle wishlist">
                        <svg class="w-6 h-6" <?= $fillAction ?> stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </button>
                </div>

                <!-- Product Details -->
                <div class="p-8 md:p-12 flex flex-col justify-center">
                    <span class="text-sm font-bold uppercase tracking-widest text-primary/80 mb-2"><?= htmlspecialchars($product['category']) ?></span>
                    <h1 class="text-3xl md:text-4xl font-heading font-bold text-gray-900 mb-4"><?= htmlspecialchars($product['name']) ?></h1>
                    
                    <div class="flex items-center mb-6">
                        <div class="flex items-center text-yellow-400">
                            <?php 
                            $rating = round($product['rating']);
                            for($i=1; $i<=5; $i++): 
                                if($i <= $rating):
                            ?>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <?php else: ?>
                                <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <?php endif; endfor; ?>
                        </div>
                        <span class="text-gray-500 ml-2 text-sm">(<?= number_format($product['reviews']) ?> reviews)</span>
                    </div>
                    
                    <p class="text-3xl font-bold text-gray-900 mb-6">$<?= number_format($product['price'], 2) ?></p>
                    
                    <div class="prose prose-sm text-gray-600 mb-8 max-w-none">
                        <p class="text-lg leading-relaxed"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                    </div>

                    <div class="mt-auto border-t border-gray-100 pt-8">
                        <?php if ($product['stock'] > 0): ?>
                        <div class="flex items-center space-x-4 mb-6">
                            <span class="text-gray-700 font-medium whitespace-nowrap">Quantity:</span>
                            <div class="flex items-center border border-gray-300 rounded-lg">
                                <button type="button" onclick="const q=document.getElementById('product-qty-<?= $product['id'] ?>'); if(q.value>1)q.value--" class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-l-lg transition-colors focus:outline-none">-</button>
                                <input type="number" id="product-qty-<?= $product['id'] ?>" value="1" min="1" max="<?= min(10, $product['stock']) ?>" class="w-12 text-center py-1 border-x border-gray-300 text-gray-900 focus:outline-none focus:ring-0" readonly>
                                <button type="button" onclick="const q=document.getElementById('product-qty-<?= $product['id'] ?>'); if(q.value<<?= min(10, $product['stock']) ?>)q.value++" class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-r-lg transition-colors focus:outline-none">+</button>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="flex items-center space-x-4">
                            <?php if ($product['stock'] > 0): ?>
                            <button onclick="addToCart(<?= $product['id'] ?>, parseInt(document.getElementById('product-qty-<?= $product['id'] ?>').value) || 1)" class="flex-1 bg-primary hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-xl shadow-[0_8px_20px_rgb(37,99,235,0.2)] hover:shadow-[0_12px_25px_rgb(37,99,235,0.3)] transition-all duration-300 transform hover:-translate-y-1 flex justify-center items-center gap-2 group/btn">
                                <svg class="w-6 h-6 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                Add to Cart
                            </button>
                            <?php else: ?>
                            <button disabled class="flex-1 bg-gray-100 text-gray-500 font-bold py-4 px-8 rounded-xl cursor-not-allowed border border-gray-200 flex justify-center items-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Out of Stock
                            </button>
                            <?php endif; ?>
                            
                            <div class="text-center px-4 border-l border-gray-200">
                                <p class="text-xs text-gray-400 font-medium tracking-wide uppercase mb-1">Status</p>
                                <?php if ($product['stock'] <= 0): ?>
                                    <p class="text-sm font-bold text-red-500">Out of Stock</p>
                                <?php elseif ($product['stock'] < 10): ?>
                                    <p class="text-sm font-bold text-orange-500">Low Stock (<?= $product['stock'] ?>)</p>
                                <?php else: ?>
                                    <p class="text-sm font-bold text-green-600">In Stock</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($related)): ?>
        <div class="mt-16">
            <h2 class="text-2xl font-heading font-bold text-gray-900 mb-8 border-b border-gray-200 pb-4">Related Products</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach ($related as $relProduct): ?>
                <div class="product-item product-card bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden flex flex-col h-full group transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative block bg-gray-50 aspect-[4/3] sm:aspect-square overflow-hidden group/image">
                        <a href="product-detail.php?id=<?= $relProduct['id'] ?>" class="block w-full h-full relative">
                            <img src="<?= htmlspecialchars($relProduct['image']) ?>" alt="<?= htmlspecialchars($relProduct['name']) ?>" loading="lazy" class="w-full h-full object-cover group-hover/image:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-black/30 opacity-0 group-hover/image:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px] z-10">
                                <span class="bg-white/95 text-gray-900 font-semibold py-2.5 px-6 rounded-full transform translate-y-4 group-hover/image:translate-y-0 transition-all duration-300 shadow-xl flex items-center gap-2 text-sm z-20">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    View Details
                                </span>
                            </div>
                        </a>
                        
                        <?php if ($relProduct['stock'] <= 0): ?>
                        <span class="absolute top-4 left-4 bg-gray-900/90 text-white text-xs font-bold px-3 py-1.5 rounded-full backdrop-blur-sm z-20">Out of Stock</span>
                        <?php endif; ?>
                        
                        <?php 
                            $isWRel = inWishlist($relProduct['id']); 
                            $relHeartClass = $isWRel ? 'text-red-500 ring-2 ring-red-200' : 'text-gray-400';
                            $relFillAction = $isWRel ? 'fill="currentColor"' : 'fill="none"';
                        ?>
                        <button onclick="toggleWishlist(<?= $relProduct['id'] ?>, this)" class="absolute top-4 right-4 bg-white/95 p-2.5 rounded-full shadow-md hover:bg-white <?= $relHeartClass ?> hover:text-red-500 transition-all duration-200 backdrop-blur-sm z-30" aria-label="Toggle wishlist">
                            <svg class="w-5 h-5 <?= $isWRel ? 'text-red-500' : 'text-gray-400 group-hover:text-red-500' ?>" <?= $relFillAction ?> stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </button>
                    </div>
                    
                    <div class="p-5 flex flex-col flex-grow">
                        <div class="flex justify-between items-start mb-2 mt-1">
                            <span class="text-xs font-bold uppercase tracking-widest text-primary/80"><?= htmlspecialchars($relProduct['category']) ?></span>
                            <div class="flex items-center text-yellow-400 text-sm">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <span class="ml-1 text-gray-600 font-medium"><?= number_format($relProduct['rating'], 1) ?></span>
                            </div>
                        </div>
                        <a href="product-detail.php?id=<?= $relProduct['id'] ?>" class="text-lg font-heading font-semibold text-gray-900 leading-tight hover:text-primary mb-3 flex-grow line-clamp-2">
                            <?= htmlspecialchars($relProduct['name']) ?>
                        </a>
                        <div class="mt-auto pt-4 flex items-center justify-between border-t border-gray-100">
                            <span class="text-xl font-bold text-gray-900">$<?= number_format($relProduct['price'], 2) ?></span>
                            
                            <?php if ($relProduct['stock'] > 0): ?>
                            <button onclick="addToCart(<?= $relProduct['id'] ?>)" class="bg-primary hover:bg-blue-700 text-white p-3 rounded-xl transition-all duration-200 shadow hover:shadow-lg active:scale-95 flex items-center justify-center group/btn" aria-label="Add to cart" title="Add to Cart">
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
        </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
