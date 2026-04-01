<?php
require_once __DIR__ . '/includes/cart-handler.php';
require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Banner -->
<section class="relative bg-gradient-to-r from-blue-900 to-primary text-white py-20 lg:py-28 text-center overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <svg class="h-full w-full object-cover" viewBox="0 0 100 100" preserveAspectRatio="none">
            <polygon fill="currentColor" points="0,100 100,0 100,100" />
        </svg>
    </div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-heading font-extrabold mb-4 animate-fade-in-up">About ShopZone</h1>
        <p class="text-xl text-blue-100 max-w-2xl mx-auto">
            Discover our journey to becoming your favorite online shopping destination for premium electronics, fashion, and home goods.
        </p>
    </div>
</section>

<!-- Our Story Section -->
<section class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center gap-12">
        <div class="w-full md:w-1/2">
            <img src="https://images.unsplash.com/photo-1472851294608-062f824d29cc?w=800&q=80" alt="ShopZone Story" class="rounded-2xl shadow-lg w-full h-auto object-cover max-h-96">
        </div>
        <div class="w-full md:w-1/2 space-y-6">
            <h2 class="text-3xl font-heading font-bold text-gray-900">Our Story</h2>
            <p class="text-lg text-gray-600 leading-relaxed">
                Founded in 2021, ShopZone started with a simple idea: to make premium shopping accessible and hassle-free. What began as a small electronics store in a garage has rapidly grown into a global marketplace offering thousands of curated products.
            </p>
            <p class="text-lg text-gray-600 leading-relaxed">
                We believe in bridging the gap between quality and affordability. Through strong relationships with top manufacturers, we cut out the middlemen so you enjoy the best prices without compromising on quality.
            </p>
            <div class="pt-4 flex border-t border-gray-100 space-x-8">
                <div>
                    <span class="block text-3xl font-bold text-primary mb-1">2M+</span>
                    <span class="text-gray-500 text-sm uppercase tracking-wider font-medium">Orders Delivered</span>
                </div>
                <div>
                    <span class="block text-3xl font-bold text-primary mb-1">98%</span>
                    <span class="text-gray-500 text-sm uppercase tracking-wider font-medium">Happy Customers</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Values Section -->
<section class="py-16 bg-light border-y border-gray-100 text-center">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-heading font-bold text-gray-900 mb-12">Our Mission & Values</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 transition-transform duration-300 hover:-translate-y-2">
                <div class="w-16 h-16 bg-blue-50 text-primary rounded-xl flex items-center justify-center mx-auto mb-6 transform rotate-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                </div>
                <h3 class="text-xl font-heading font-bold text-gray-900 mb-4">Quality First</h3>
                <p class="text-gray-600 leading-relaxed">We never compromise on quality. Every product in our catalog passes rigorous testing to ensure your complete satisfaction.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 transition-transform duration-300 hover:-translate-y-2">
                <div class="w-16 h-16 bg-orange-50 text-accent rounded-xl flex items-center justify-center mx-auto mb-6 transform rotate-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-heading font-bold text-gray-900 mb-4">Global Reach</h3>
                <p class="text-gray-600 leading-relaxed">Shopping has no borders. We offer fast and reliable shipping to over 50 countries, bringing trends right to your doorstep.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 transition-transform duration-300 hover:-translate-y-2">
                <div class="w-16 h-16 bg-green-50 text-green-500 rounded-xl flex items-center justify-center mx-auto mb-6 transform rotate-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                </div>
                <h3 class="text-xl font-heading font-bold text-gray-900 mb-4">Customer Joy</h3>
                <p class="text-gray-600 leading-relaxed">Your happiness is our priority. Our 24/7 dedicated support team works tirelessly to resolve issues quickly and smoothly.</p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-16 md:py-24 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-heading font-bold text-gray-900 mb-4">Meet Our Team</h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-12">The passionate individuals behind your seamless shopping experience.</p>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="flex flex-col items-center group">
                <div class="w-32 h-32 rounded-full overflow-hidden mb-4 border-4 border-white shadow-lg">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&q=80" alt="Sarah Connor" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <h4 class="text-xl font-heading font-bold text-gray-900">Sarah Connor</h4>
                <p class="text-primary font-medium text-sm uppercase tracking-wide">CEO & Founder</p>
            </div>
            <div class="flex flex-col items-center group">
                <div class="w-32 h-32 rounded-full overflow-hidden mb-4 border-4 border-white shadow-lg">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&q=80" alt="John Davis" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <h4 class="text-xl font-heading font-bold text-gray-900">John Davis</h4>
                <p class="text-primary font-medium text-sm uppercase tracking-wide">Head of Product</p>
            </div>
            <div class="flex flex-col items-center group">
                <div class="w-32 h-32 rounded-full overflow-hidden mb-4 border-4 border-white shadow-lg">
                    <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=400&q=80" alt="Emily Chen" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <h4 class="text-xl font-heading font-bold text-gray-900">Emily Chen</h4>
                <p class="text-primary font-medium text-sm uppercase tracking-wide">Marketing Director</p>
            </div>
            <div class="flex flex-col items-center group">
                <div class="w-32 h-32 rounded-full overflow-hidden mb-4 border-4 border-white shadow-lg">
                    <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&q=80" alt="Marcus Johnson" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <h4 class="text-xl font-heading font-bold text-gray-900">Marcus Johnson</h4>
                <p class="text-primary font-medium text-sm uppercase tracking-wide">Lead Developer</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-gray-900 text-white text-center">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="p-4">
                <div class="text-4xl lg:text-5xl font-heading font-bold text-primary mb-2">500+</div>
                <div class="text-gray-400 font-medium uppercase tracking-widest text-sm">Products</div>
            </div>
            <div class="p-4 border-l border-gray-800">
                <div class="text-4xl lg:text-5xl font-heading font-bold text-primary mb-2">10k+</div>
                <div class="text-gray-400 font-medium uppercase tracking-widest text-sm">Customers</div>
            </div>
            <div class="p-4 border-l border-gray-800">
                <div class="text-4xl lg:text-5xl font-heading font-bold text-primary mb-2">5 Yrs</div>
                <div class="text-gray-400 font-medium uppercase tracking-widest text-sm">Active</div>
            </div>
            <div class="p-4 border-l border-gray-800">
                <div class="text-4xl lg:text-5xl font-heading font-bold text-primary mb-2">4.8★</div>
                <div class="text-gray-400 font-medium uppercase tracking-widest text-sm">Rating</div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
