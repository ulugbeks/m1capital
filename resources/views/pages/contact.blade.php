@extends('layouts.app')

@section('content')
    <header class="header">
        <div class="header__content">
            <h1 class="header__title">{!! $page->hero_title ?? 'Get in <br> touch' !!}</h1>
        </div>
    </header>

    @php
        $content = $page->content;
    @endphp

    <section class="contact">
        <div class="contact__info">
            <p class="contact__title">{{ $content['contact_details']['title'] ?? 'Contact details:' }}</p>
            <p class="contact__description">{!! $content['contact_details']['office_address'] ?? 'Office address: <br>
                <br>
                1 Waterside <br>
                Station Road <br>
                Harpenden <br>
                AL5 4US' !!}
            </p>
            <p class="contact__description">
                {{ $content['contact_details']['registered_label'] ?? 'Registered address:' }}
            </p>
            <p class="contact__description">
                {!! $content['contact_details']['registered_address'] ?? 'Unit 4 <br>
                The Edge Business Park <br>
                Brownfields <br>
                Welwyn Garden City <br>
                Hertfordshire <br>
                AL7 1WX' !!}
            </p>
        </div>
        <form class="contact__form" id="contactForm" method="POST" action="{{ route('contact.submit', app()->getLocale()) }}">
            @csrf
            
            {{-- Message Container for AJAX responses --}}
            <div id="messageContainer"></div>

            <div class="input-wrap">
                <div class="input-group">
                    <label for="first-name">{{ __('First name') }}*</label>
                    <input type="text" id="first-name" name="first_name" value="{{ old('first_name') }}" required>
                    <span class="error-message" id="first_name_error"></span>
                </div>
                <div class="input-group">
                    <label for="last-name">{{ __('Last name') }}*</label>
                    <input type="text" id="last-name" name="last_name" value="{{ old('last_name') }}" required>
                    <span class="error-message" id="last_name_error"></span>
                </div>
            </div>
            
            <label for="company">{{ __('Company') }}</label>
            <input type="text" id="company" name="company" value="{{ old('company') }}">
            
            <label for="email">{{ __('Email') }}*</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            <span class="error-message" id="email_error"></span>
            
            <label for="telephone">{{ __('Telephone') }}</label>
            <input type="tel" id="telephone" name="telephone" value="{{ old('telephone') }}">
            <input type="hidden" id="telephone_full" name="telephone_full">
            <span class="error-message" id="telephone_error"></span>
            
            <!-- <label for="message">{{ __('Please tell us a bit about your site') }}</label>
            <textarea id="message" name="message">{{ old('message') }}</textarea> -->
            
            <div class="contact__checkbox">
                <input type="checkbox" id="privacy" name="privacy" {{ old('privacy') ? 'checked' : '' }} required>
                <label for="privacy">{{ __('I agree with the privacy statement') }}*</label>
                <span class="error-message" id="privacy_error"></span>
            </div>
            
            <button type="submit" class="circleBg-btn contact__button" id="submitBtn">
                <span class="btn-text">{{ __('Send message') }}</span>
                <div class="_i_bg"></div>
                <i class="btn-icon fas fa-arrow-right"></i>
            </button>
        </form>
    </section>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
        <style>
            .header__title, .header__subtitle, .header__note, .header__note i {
                color: #000!important;
            }
            header {
                width: 100%;
                min-height: 18vh;
                position: relative;
            }
            
            /* Alert Styles */
            .alert {
                padding: 15px 20px;
                margin-bottom: 20px;
                border-radius: 5px;
                position: relative;
                animation: slideIn 0.3s ease-out;
            }
            
            .alert i {
                margin-right: 10px;
            }
            
            .alert-success {
                background-color: #d4edda;
                border: 1px solid #c3e6cb;
                color: #155724;
            }
            
            .alert-danger {
                background-color: #f8d7da;
                border: 1px solid #f5c6cb;
                color: #721c24;
            }
            
            .alert-warning {
                background-color: #fff3cd;
                border: 1px solid #ffeeba;
                color: #856404;
            }
            
            .alert ul {
                margin: 10px 0 0 25px;
                padding: 0;
            }
            
            .alert ul li {
                margin-bottom: 5px;
            }
            
            .error-message {
                color: #dc3545;
                font-size: 14px;
                margin-top: 5px;
                display: block;
                min-height: 20px;
            }
            
            .input-error {
                border-color: #dc3545 !important;
            }
            
            .contact__button[disabled] {
                opacity: 0.7;
                cursor: not-allowed;
            }
            
            /* International Telephone Input Styles */
            .iti {
                width: 100%;
            }
            
            .iti__flag-container {
                padding: 0;
            }
            
            .iti__selected-flag {
                padding: 0 6px 0 8px;
            }

            .circleBg-btn ._i_bg {
                right: 38px;
            }
            
            .iti__country-list {
                z-index: 1050;
                /* width: 100%;*/
                max-width: 400px;
            }
            
            .iti.iti--separate-dial-code .iti__selected-flag {
                background-color: #f9f9f9;
                border: 1px solid #ddd;
                 border-right: none;
            }
            
            .iti.iti--separate-dial-code .iti__selected-dial-code {
                margin-left: 6px;
            }
            
            .iti--allow-dropdown input[type="tel"] {
                padding-left: 52px !important;
            }
            
            .iti--separate-dial-code input[type="tel"] {
                padding-left: 90px !important;
            }
            
            .contact__form .iti input[type="tel"] {
                width: 100%;
                padding: 15px;
                border: 1px solid #ddd;
                border-radius: 5px;
                font-size: 16px;
                background-color: #fff;
                transition: border-color 0.3s;
            }
            
            .contact__form .iti input[type="tel"]:focus {
                outline: none;
                border-color: #666;
            }
            
            .iti__country-list {
                border-radius: 5px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
            
            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            @keyframes spin {
                to {
                    transform: rotate(360deg);
                }
            }
            
            .fa-spinner {
                animation: spin 1s linear infinite;
            }
        </style>
    @endpush
    
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('contactForm');
            const submitBtn = document.getElementById('submitBtn');
            const messageContainer = document.getElementById('messageContainer');
            
            // Initialize international telephone input
            const phoneInput = document.querySelector("#telephone");
            const phoneFullInput = document.querySelector("#telephone_full");
            const iti = window.intlTelInput(phoneInput, {
                // Options
                initialCountry: "auto",
                geoIpLookup: function(callback) {
                    // Using ipapi.co for free IP geolocation
                    fetch('https://ipapi.co/json/')
                        .then(res => res.json())
                        .then(data => {
                            const countryCode = (data && data.country_code) ? data.country_code : "lv";
                            callback(countryCode.toLowerCase());
                        })
                        .catch(() => {
                            callback("lv"); // Fallback to Latvia if geolocation fails
                        });
                },
                preferredCountries: ["lv", "gb", "us", "de", "fr"],
                separateDialCode: true,
                nationalMode: false,
                autoPlaceholder: "aggressive",
                placeholderNumberType: "MOBILE",
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
                customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                    return selectedCountryPlaceholder;
                }
            });
            
            // Update hidden field with full number on change
            phoneInput.addEventListener('change', updatePhoneNumber);
            phoneInput.addEventListener('keyup', updatePhoneNumber);
            phoneInput.addEventListener('blur', validatePhoneNumber);
            
            function updatePhoneNumber() {
                const number = phoneInput.value.trim();
                if (number) {
                    if (iti.isValidNumber()) {
                        phoneFullInput.value = iti.getNumber(); // This gets the full international format
                        phoneInput.classList.remove('input-error');
                        document.getElementById('telephone_error').textContent = '';
                    } else {
                        phoneFullInput.value = iti.getNumber(); // Still get the number with country code
                    }
                } else {
                    phoneFullInput.value = '';
                }
            }
            
            function validatePhoneNumber() {
                if (phoneInput.value.trim() && !iti.isValidNumber()) {
                    phoneInput.classList.add('input-error');
                    document.getElementById('telephone_error').textContent = 'Please enter a valid phone number';
                }
            }
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validate phone number if provided
                if (phoneInput.value.trim() && !iti.isValidNumber()) {
                    phoneInput.classList.add('input-error');
                    document.getElementById('telephone_error').textContent = 'Please enter a valid phone number';
                    return;
                }
                
                // Clear previous errors
                clearErrors();
                
                // Disable submit button and show loading state
                submitBtn.disabled = true;
                const btnText = submitBtn.querySelector('.btn-text');
                const btnIcon = submitBtn.querySelector('.btn-icon');
                const originalText = btnText.textContent;
                
                btnText.textContent = 'Sending...';
                btnIcon.classList.remove('fa-arrow-right');
                btnIcon.classList.add('fa-spinner', 'fa-spin');
                
                // Create FormData object
                const formData = new FormData(form);
                
                // Send AJAX request
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message
                        showMessage('success', data.message);
                        
                        // Reset form
                        form.reset();
                        
                        // Scroll to top to show message
                        messageContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    } else {
                        // Show error message
                        showMessage('danger', data.message || 'An error occurred. Please try again.');
                        
                        // Show validation errors if any
                        if (data.errors) {
                            showValidationErrors(data.errors);
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('danger', 'An unexpected error occurred. Please try again later.');
                })
                .finally(() => {
                    // Re-enable submit button and restore original state
                    submitBtn.disabled = false;
                    btnText.textContent = originalText;
                    btnIcon.classList.remove('fa-spinner', 'fa-spin');
                    btnIcon.classList.add('fa-arrow-right');
                });
            });
            
            function showMessage(type, message) {
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${type}`;
                
                const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
                alertDiv.innerHTML = `<i class="fas ${icon}"></i>${message}`;
                
                messageContainer.innerHTML = '';
                messageContainer.appendChild(alertDiv);
                
                // Auto-hide success messages after 5 seconds
                if (type === 'success') {
                    setTimeout(() => {
                        alertDiv.style.transition = 'opacity 0.5s ease-out';
                        alertDiv.style.opacity = '0';
                        setTimeout(() => {
                            alertDiv.remove();
                        }, 500);
                    }, 5000);
                }
            }
            
            function showValidationErrors(errors) {
                Object.keys(errors).forEach(field => {
                    const errorElement = document.getElementById(field + '_error');
                    const inputElement = document.querySelector(`[name="${field}"]`);
                    
                    if (errorElement && errors[field][0]) {
                        errorElement.textContent = errors[field][0];
                    }
                    
                    if (inputElement) {
                        inputElement.classList.add('input-error');
                    }
                });
            }
            
            function clearErrors() {
                // Clear all error messages
                document.querySelectorAll('.error-message').forEach(el => {
                    el.textContent = '';
                });
                
                // Remove error styling from inputs
                document.querySelectorAll('.input-error').forEach(el => {
                    el.classList.remove('input-error');
                });
                
                // Clear message container
                messageContainer.innerHTML = '';
            }
            
            // Clear error on input change
            form.querySelectorAll('input, textarea').forEach(input => {
                input.addEventListener('input', function() {
                    if (this.classList.contains('input-error')) {
                        this.classList.remove('input-error');
                        const errorElement = document.getElementById(this.name + '_error');
                        if (errorElement) {
                            errorElement.textContent = '';
                        }
                    }
                });
            });
        });
    </script>
    @endpush
@endsection