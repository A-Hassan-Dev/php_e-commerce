document.addEventListener('DOMContentLoaded', () => {
    // Top-level variables
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');

    // Mobile Menu Toggle
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Scroll to Top functionality
    if (scrollToTopBtn) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                scrollToTopBtn.classList.add('show');
            } else {
                scrollToTopBtn.classList.remove('show');
            }
        });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});

// Toast notification system
function showToast(message, type = 'info') {
    const toastContainer = document.getElementById('toast-container') || createToastContainer();
    
    const toast = document.createElement('div');
    // Premium glassmorphism toast design with Tailwind
    toast.className = 'flex items-center w-full max-w-sm p-4 mb-4 bg-white/95 backdrop-blur-xl border border-white/20 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.08)] transform transition-all duration-500 translate-x-full opacity-0 relative overflow-hidden';
    toast.setAttribute('role', 'alert');
    
    let iconHTML = '';
    let accentColor = '';
    if (type === 'success') {
        accentColor = 'bg-green-500';
        iconHTML = `<div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 rounded-full bg-green-50 text-green-500 ring-4 ring-green-50/50">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
        </div>`;
    } else if (type === 'error') {
        accentColor = 'bg-red-500';
        iconHTML = `<div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 rounded-full bg-red-50 text-red-500 ring-4 ring-red-50/50">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
        </div>`;
    } else {
        accentColor = 'bg-blue-500';
        iconHTML = `<div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 rounded-full bg-blue-50 text-blue-500 ring-4 ring-blue-50/50">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>`;
    }

    toast.innerHTML = `
        <div class="absolute left-0 top-0 bottom-0 w-1 ${accentColor}"></div>
        <div class="ml-2 flex flex-col justify-center">
            ${iconHTML}
        </div>
        <div class="ml-4 mr-2">
            <h4 class="text-sm font-bold text-gray-900 leading-tight">${type === 'success' ? 'Success!' : type === 'error' ? 'Whoops!' : 'Notification'}</h4>
            <p class="text-sm text-gray-600 mt-0.5">${message}</p>
        </div>
        <button type="button" class="ml-auto -mr-1 bg-transparent text-gray-400 hover:text-gray-900 rounded-lg p-1.5 hover:bg-gray-100/50 inline-flex transition-colors cursor-pointer focus:outline-none" onclick="dismissToast(this.parentElement)">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    `;

    toastContainer.appendChild(toast);

    // Trigger enter animation
    requestAnimationFrame(() => {
        toast.classList.remove('translate-x-full', 'opacity-0');
        toast.classList.add('translate-x-0', 'opacity-100');
    });

    // Auto dismiss
    setTimeout(() => {
        dismissToast(toast);
    }, 5000);
}

function dismissToast(toastEl) {
    if(toastEl && toastEl.parentElement) {
        toastEl.classList.remove('translate-x-0', 'opacity-100');
        toastEl.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => {
            if(toastEl.parentElement) toastEl.remove();
        }, 500); // Wait for CSS transition
    }
}

function createToastContainer() {
    const container = document.createElement('div');
    container.id = 'toast-container';
    container.className = 'fixed top-6 right-6 z-[100] flex flex-col gap-3 w-full max-w-sm pointer-events-none';
    // Make children clickable
    container.style.cssText = `
        pointer-events: none;
    `;
    // We add a class that allows pointer events on children
    const style = document.createElement('style');
    style.textContent = '#toast-container > div { pointer-events: auto; }';
    document.head.appendChild(style);
    document.body.appendChild(container);
    return container;
}

// Update the cart badge on the navbar
function updateCartBadge(count) {
    const badges = document.querySelectorAll('.cart-count-badge');
    badges.forEach(badge => {
        badge.textContent = count;
        if (count > 0) {
            badge.classList.remove('hidden');
        } else {
            badge.classList.add('hidden');
        }
    });
}
