<?php
require_once __DIR__ . '/includes/cart-handler.php';
require_once __DIR__ . '/includes/header.php';
?>

<!-- Header -->
<div class="relative bg-gradient-to-r from-blue-900 to-primary text-white py-16 text-center overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <svg class="h-full w-full object-cover" viewBox="0 0 100 100" preserveAspectRatio="none">
            <polygon fill="currentColor" points="100,0 0,100 100,100" />
        </svg>
    </div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-heading font-extrabold mb-4 animate-fade-in-up">Contact Us</h1>
        <p class="text-xl text-blue-100 max-w-2xl mx-auto">
            Have a question, feedback, or need help? We're here for you 24/7.
        </p>
    </div>
</div>

<section class="py-16 bg-light border-b border-gray-100 flex-grow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col-reverse lg:flex-row gap-12 lg:gap-8">
            
            <!-- Contact Form -->
            <div class="w-full lg:w-3/5 order-2 lg:order-1">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <h2 class="text-2xl font-heading font-bold text-gray-900 mb-6 border-b border-gray-100 pb-4">Send us a message</h2>
                    
                    <div id="contact-success" class="hidden bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg shadow-sm">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="font-semibold text-green-800">Message sent successfully!</span>
                        </div>
                        <p class="text-green-700 mt-1 text-sm pl-8">We will get back to you shortly.</p>
                    </div>

                    <form id="contact-form" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="contact-name" class="block text-sm font-medium text-gray-700 mb-1">Your Name *</label>
                                <input type="text" id="contact-name" name="name" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary shadow-sm outline-none transition-colors" required>
                            </div>
                            <div>
                                <label for="contact-email" class="block text-sm font-medium text-gray-700 mb-1">Your Email *</label>
                                <input type="email" id="contact-email" name="email" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary shadow-sm outline-none transition-colors" required>
                            </div>
                        </div>

                        <div>
                            <label for="contact-subject" class="block text-sm font-medium text-gray-700 mb-1">Subject *</label>
                            <input type="text" id="contact-subject" name="subject" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary shadow-sm outline-none transition-colors" required>
                        </div>

                        <div>
                            <label for="contact-message" class="block text-sm font-medium text-gray-700 mb-1">Message *</label>
                            <textarea id="contact-message" name="message" rows="5" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary shadow-sm outline-none transition-colors resize-y" required></textarea>
                        </div>

                        <button type="submit" class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-lg shadow font-heading tracking-wide transition-colors">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>

            <!-- Contact Information & Map -->
            <div class="w-full lg:w-2/5 order-1 lg:order-2 space-y-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-6">
                    <!-- Address Card -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start gap-4">
                        <div class="bg-blue-50 p-3 rounded-full text-primary flex-shrink-0 mt-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-heading font-bold text-gray-900 mb-1">Visit Us</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">123 Commerce Blvd,<br>Suite 400<br>San Francisco, CA 94105</p>
                        </div>
                    </div>

                    <!-- Email Card -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start gap-4">
                        <div class="bg-blue-50 p-3 rounded-full text-primary flex-shrink-0 mt-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-heading font-bold text-gray-900 mb-1">Email Us</h3>
                            <p class="text-sm text-gray-600 mb-1">Support: support@shopzone.com</p>
                            <p class="text-sm text-gray-600">Sales: sales@shopzone.com</p>
                        </div>
                    </div>

                    <!-- Phone Card -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start gap-4">
                        <div class="bg-blue-50 p-3 rounded-full text-primary flex-shrink-0 mt-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-heading font-bold text-gray-900 mb-1">Call Us</h3>
                            <p class="text-sm text-gray-600 mb-1">+1 (800) 123-4567</p>
                            <p class="text-xs text-gray-500 font-medium">Mon-Fri from 8am to 5pm</p>
                        </div>
                    </div>
                </div>

                <!-- Google Maps Embed -->
                <div class="bg-gray-200 rounded-xl overflow-hidden shadow-sm border border-gray-100 h-64 relative">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d100940.142459992!2d-122.5076402484084!3d37.75767917411603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80859a6d00690021%3A0x4a501367f076adff!2sSan%20Francisco%2C%20CA!5e0!3m2!1sen!2sus!4v1700684074068!5m2!1sen!2sus" class="absolute inset-0 w-full h-full" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const contactForm = document.getElementById('contact-form');
    const successMsg = document.getElementById('contact-success');

    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            // Simple validation (relying on HTML5 required attrs for primary validation)
            const email = document.getElementById('contact-email').value;
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            
            if (!re.test(String(email).toLowerCase())) {
                showToast('Please enter a valid email address.', 'error');
                return;
            }

            // Simulate form submission
            setTimeout(() => {
                contactForm.reset();
                contactForm.style.display = 'none';
                successMsg.classList.remove('hidden');
                
                // Show form again after 5 seconds just in case
                setTimeout(() => {
                    successMsg.classList.add('hidden');
                    contactForm.style.display = 'block';
                }, 5000);
            }, 800);
        });
    }
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
