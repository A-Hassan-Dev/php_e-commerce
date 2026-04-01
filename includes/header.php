<?php
require_once __DIR__ . '/cart-handler.php';
require_once __DIR__ . '/wishlist-handler.php';
$cartCount = getCartCount();
$wishlistCount = getWishlistCount();
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopZone - Discover Amazing Products</title>
    <link rel="shortcut icon" href="https://simicart.com/wp-content/uploads/eCommerce-logo.jpg" type="image/x-icon">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (CDN per instructions) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1A56DB',
                        accent: '#F97316',
                        light: '#F9FAFB'
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body class="bg-light text-gray-800 font-sans antialiased flex flex-col min-h-screen">

    <!-- Sticky Navbar -->
    <nav class="bg-white shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="index.php" class="flex-shrink-0 flex items-center gap-2">
                        <svg class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span class="font-heading font-bold text-2xl text-gray-900 tracking-tight">ShopZone</span>
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden sm:flex sm:items-center sm:space-x-8">
                    <a href="index.php" class="text-gray-600 hover:text-primary nav-link font-medium <?= $currentPage == 'index.php' ? 'active text-primary' : '' ?>">Home</a>
                    <a href="products.php" class="text-gray-600 hover:text-primary nav-link font-medium <?= $currentPage == 'products.php' ? 'active text-primary' : '' ?>">Products</a>
                    <a href="about.php" class="text-gray-600 hover:text-primary nav-link font-medium <?= $currentPage == 'about.php' ? 'active text-primary' : '' ?>">About</a>
                    <a href="contact.php" class="text-gray-600 hover:text-primary nav-link font-medium <?= $currentPage == 'contact.php' ? 'active text-primary' : '' ?>">Contact</a>
                </div>

                <!-- Wishlist, Cart Icon & Mobile Burger -->
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <a href="wishlist.php" class="text-gray-600 hover:text-red-500 relative p-2 transition-colors duration-200">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span class="wishlist-count-badge absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-[10px] font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-red-500 rounded-full <?= $wishlistCount == 0 ? 'hidden' : '' ?>"><?= $wishlistCount ?></span>
                    </a>
                    <a href="cart.php" class="text-gray-600 hover:text-primary relative p-2 transition-colors duration-200">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="cart-count-badge absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-[10px] font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-accent rounded-full <?= $cartCount == 0 ? 'hidden' : '' ?>"><?= $cartCount ?></span>
                    </a>
                    
                    <button id="mobile-menu-btn" class="sm:hidden text-gray-600 hover:text-primary focus:outline-none p-2">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu (Hidden by default) -->
        <div id="mobile-menu" class="hidden sm:hidden bg-white border-t border-gray-100">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="index.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50 <?= $currentPage == 'index.php' ? 'text-primary bg-blue-50' : '' ?>">Home</a>
                <a href="products.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50 <?= $currentPage == 'products.php' ? 'text-primary bg-blue-50' : '' ?>">Products</a>
                <a href="about.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50 <?= $currentPage == 'about.php' ? 'text-primary bg-blue-50' : '' ?>">About</a>
                <a href="contact.php" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50 <?= $currentPage == 'contact.php' ? 'text-primary bg-blue-50' : '' ?>">Contact</a>
            </div>
        </div>
    </nav>
    <main class="flex-grow">
