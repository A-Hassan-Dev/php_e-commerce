<?php
require_once __DIR__ . '/includes/cart-handler.php';
require_once __DIR__ . '/includes/header.php';
?>

<section class="py-24 bg-light flex-grow flex items-center justify-center">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        
        <div class="mb-8 relative inline-block">
            <h1 class="text-[150px] font-heading font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-900 to-primary leading-none">404</h1>
            <div class="absolute inset-0 flex items-center justify-center opacity-10">
                <svg class="w-full h-full text-primary" fill="currentColor" viewBox="0 0 24 24"><path d="M11 15h2v2h-2zm0-8h2v6h-2zm.99-5C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/></svg>
            </div>
        </div>
        
        <h2 class="text-3xl font-heading font-bold text-gray-900 mb-4">Page Not Found</h2>
        <p class="text-lg text-gray-600 mb-8 max-w-lg mx-auto">
            Oops! The page you are looking for doesn't exist. It might have been moved or deleted.
        </p>
        
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="index.php" class="bg-primary hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg shadow-md transition-colors flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Go to Homepage
            </a>
            <a href="products.php" class="bg-white border-2 border-primary text-primary hover:bg-blue-50 font-semibold py-3 px-8 rounded-lg shadow-sm transition-colors flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Shop Products
            </a>
        </div>
        
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
