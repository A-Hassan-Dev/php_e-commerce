document.addEventListener('DOMContentLoaded', () => {
    const checkoutForm = document.getElementById('checkout-form');
    if (!checkoutForm) return;

    checkoutForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Reset errors
        document.querySelectorAll('.error-msg').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.form-input').forEach(el => {
            el.classList.remove('border-red-500', 'focus:ring-red-500');
            el.classList.add('border-gray-300', 'focus:ring-blue-500');
        });

        let isValid = true;

        // Validation Rules
        const requiredFields = ['fullName', 'email', 'phone', 'address', 'city', 'postalCode', 'country'];
        
        requiredFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (!field.value.trim()) {
                showError(field);
                isValid = false;
            } else if (fieldId === 'email' && !validateEmail(field.value)) {
                showError(field, 'Please enter a valid email address.');
                isValid = false;
            }
        });

        if (isValid) {
            // Because this is a static demo, we just submit the form. PHP handles the rest.
            checkoutForm.submit();
        } else {
            showToast('Please fill in all required fields correctly.', 'error');
        }
    });

    function showError(inputEl, message = 'This field is required.') {
        inputEl.classList.remove('border-gray-300', 'focus:ring-blue-500');
        inputEl.classList.add('border-red-500', 'focus:ring-red-500');
        
        const errorEl = document.getElementById(`${inputEl.id}-error`);
        if (errorEl) {
            errorEl.textContent = message;
            errorEl.classList.remove('hidden');
        }
    }

    function validateEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
});
