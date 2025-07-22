<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @php
        $version = config('app.version', time());
        $currentRoute = request()->route()->getName();
        $isHomePage = $currentRoute === 'home';
    @endphp
    
    <link rel="stylesheet" href="{{ asset('css/index.css') }}?v={{ $version }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v={{ $version }}">
    <link rel="stylesheet" href="{{ asset('css/solution.css') }}?v={{ $version }}">
    <link rel="stylesheet" href="{{ asset('css/language-switcher.css') }}?v={{ $version }}">
    <link rel="stylesheet" href="{{ asset('css/medias.css') }}?v={{ $version }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $page->meta_title ?? $page->title ?? config('app.name'))</title>
    <meta name="description" content="@yield('description', $page->meta_description ?? '')">
    <meta name="keywords" content="@yield('keywords', $page->meta_keywords ?? '')">
    
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v={{ $version }}">

    <!-- Инициализация Consent Mode перед GTM -->
    <script>
    // Инициализация Google Consent Mode V2
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}

    // Установка значений по умолчанию для Consent Mode V2
    gtag('consent', 'default', {
        'ad_storage': 'denied',
        'analytics_storage': 'denied',
        'functionality_storage': 'denied',
        'personalization_storage': 'denied',
        'security_storage': 'granted',
        'ad_user_data': 'denied',
        'ad_personalization': 'denied'
    });

    // Проверка сохраненных настроек согласия
    function checkSavedConsent() {
        const match = document.cookie.match(new RegExp('(^| )cookie_consent=([^;]+)'));
        if (match) {
            try {
                const preferences = JSON.parse(decodeURIComponent(match[2]));
                gtag('consent', 'update', {
                    'analytics_storage': preferences.analytics ? 'granted' : 'denied',
                    'ad_storage': preferences.marketing ? 'granted' : 'denied',
                    'functionality_storage': preferences.necessary ? 'granted' : 'denied',
                    'personalization_storage': preferences.marketing ? 'granted' : 'denied',
                    'ad_user_data': preferences.marketing ? 'granted' : 'denied',
                    'ad_personalization': preferences.marketing ? 'granted' : 'denied'
                });
            } catch (e) {
                console.error('Error parsing consent cookie', e);
            }
        }
    }
    
    // Проверяем и применяем сохраненные настройки
    checkSavedConsent();
    </script>


    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-N000000');</script>
    <!-- End Google Tag Manager -->
    
    @stack('styles')
</head>

<body class="{{ $isHomePage ? 'home-page' : 'inner-page' }}" data-route="{{ $currentRoute }}">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N000000"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="start-frame"></div>

    @include('partials.navigation')

    @yield('content')

    @include('partials.footer')

    @stack('modals')

    <!-- Cookie Banner HTML -->
    <div id="cookie-banner" class="cookie-banner">
        <div class="cookie-banner-container">
            <div class="cookie-banner-header">
                <h3>{{ __('We use cookies on this website') }}</h3>
                
            </div>
            <div class="cookie-banner-content">
                <p>{{ __('This website uses cookies to improve your experience while browsing our site. Of these cookies, those classified as necessary are stored in your browser as they are essential for the basic functionality of the website.') }}</p>
                <p>{{ __('We also use third-party cookies that help us analyze and understand how you use this website. These cookies will be stored in your browser only with your consent.') }}</p>
            </div>
            <div class="cookie-banner-actions">
                <button id="accept-all-btn" class="cookie-btn cookie-btn-primary">{{ __('Accept all') }}</button>
                <button id="reject-all-btn" class="cookie-btn cookie-btn-secondary">{{ __('Reject') }}</button>
                <button id="cookie-settings-btn" class="cookie-btn cookie-btn-secondary">{{ __('Customize selection') }}</button>
            </div>
        </div>
        
        <!-- Cookie Settings Modal -->
        <div id="cookie-settings-modal" class="cookie-settings-modal">
            <div class="cookie-settings-container">
                <div class="cookie-settings-header">
                    <h3>{{ __('Cookie settings') }}</h3>
                    <button id="close-settings-btn" class="close-settings-btn">&times;</button>
                </div>
                <div class="cookie-settings-content">
                    <div class="cookie-category">
                        <div class="cookie-category-header">
                            <h4>{{ __('Necessary cookies') }}</h4>
                            <label class="cookie-switch">
                                <input type="checkbox" checked disabled>
                                <span class="cookie-slider"></span>
                            </label>
                        </div>
                        <p>{{ __('These cookies are necessary for the website to function and cannot be switched off in our systems.') }}</p>
                    </div>
                    
                    <div class="cookie-category">
                        <div class="cookie-category-header">
                            <h4>{{ __('Analytics cookies') }}</h4>
                            <label class="cookie-switch">
                                <input type="checkbox" id="analytics-cookies-checkbox">
                                <span class="cookie-slider"></span>
                            </label>
                        </div>
                        <p>{{ __('These cookies allow us to count visits and traffic sources so we can measure and improve the performance of our site.') }}</p>
                    </div>
                    
                    <div class="cookie-category">
                        <div class="cookie-category-header">
                            <h4>{{ __('Marketing cookies') }}</h4>
                            <label class="cookie-switch">
                                <input type="checkbox" id="marketing-cookies-checkbox">
                                <span class="cookie-slider"></span>
                            </label>
                        </div>
                        <p>{{ __('These cookies may be set on our website by our advertising partners to build a profile of your interests.') }}</p>
                    </div>
                </div>
                <div class="cookie-settings-footer">
                    <button id="save-settings-btn" class="cookie-btn cookie-btn-primary">{{ __('Save settings') }}</button>
                </div>
            </div>
        </div>
    </div>

    <style>
    /* Cookie Banner Styles */
    .cookie-banner {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    justify-content: center;
    align-items: center;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

.cookie-banner-container {
    background-color: #fff;
    border-radius: 8px;
    width: 90%;
    max-width: 600px;
    max-height: 80vh;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    overflow-y: auto;
}

.cookie-banner-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.cookie-banner-header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    color: #333;
}

.cookie-settings-btn {
    background: none;
    border: none;
    color: #1d2a4d;
    font-size: 14px;
    cursor: pointer;
    text-decoration: underline;
    padding: 0;
}

.cookie-banner-content {
    margin-bottom: 20px;
}

.cookie-banner-content p {
    margin: 0 0 10px;
    font-size: 14px;
    line-height: 1.5;
    color: #666;
}

.cookie-banner-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: flex-end;
}

.cookie-btn {
    padding: 8px 16px;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    border: none;
    transition: background-color 0.3s;
}

.cookie-btn-primary {
    background-color: #1d2a4d;
    color: white;
}

.cookie-btn-primary:hover {
    background-color: #2c5cc5;
}

.cookie-btn-secondary {
    background-color: #f1f1f1;
    color: #333;
}

.cookie-btn-secondary:hover {
    background-color: #e0e0e0;
}

    /* Cookie Settings Modal */
    .cookie-settings-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 10000;
        justify-content: center;
        align-items: center;
    }

    .cookie-settings-container {
        background-color: #fff;
        border-radius: 8px;
        width: 90%;
        max-width: 600px;
        max-height: 80vh;
        overflow-y: auto;
    }

    .cookie-settings-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid #eee;
    }

    .cookie-settings-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        color: #333;
    }

    .close-settings-btn {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #666;
    }

    .cookie-settings-content {
        padding: 20px;
    }

    .cookie-category {
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }

    .cookie-category:last-child {
        border-bottom: none;
    }

    .cookie-category-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .cookie-category-header h4 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }

    .cookie-category p {
        margin: 0;
        font-size: 14px;
        line-height: 1.5;
        color: #666;
    }

    /* Toggle Switch */
    .cookie-switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    .cookie-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .cookie-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }

    .cookie-slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .cookie-slider {
        background-color: #1d2a4d;
    }

    input:checked + .cookie-slider:before {
        transform: translateX(26px);
    }

    .cookie-settings-footer {
        padding: 20px;
        border-top: 1px solid #eee;
        text-align: right;
    }

    /* Responsive adjustments */
    @media (max-width: 480px) {
        .cookie-banner {
            bottom: 0;
            left: 0;
            right: 0;
            max-width: none;
            border-radius: 8px 8px 0 0;
        }
        
        .cookie-banner-actions {
            flex-direction: column;
        }
        
        .cookie-btn {
            width: 100%;
        }
    }
    </style>

    <script>
        // Передаем информацию о текущей странице в JavaScript
        window.pageInfo = {
            isHomePage: {{ $isHomePage ? 'true' : 'false' }},
            currentRoute: '{{ $currentRoute }}',
            locale: '{{ app()->getLocale() }}'
        };



        // Cookie Banner JavaScript с интеграцией Google Consent Mode
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const cookieBanner = document.getElementById('cookie-banner');
            const settingsBtn = document.getElementById('cookie-settings-btn');
            const acceptAllBtn = document.getElementById('accept-all-btn');
            const rejectAllBtn = document.getElementById('reject-all-btn');
            const savePreferencesBtn = document.getElementById('save-preferences-btn');
            const cookieSettingsModal = document.getElementById('cookie-settings-modal');
            const closeSettingsBtn = document.getElementById('close-settings-btn');
            const saveSettingsBtn = document.getElementById('save-settings-btn');
            const analyticsCheckbox = document.getElementById('analytics-cookies-checkbox');
            const marketingCheckbox = document.getElementById('marketing-cookies-checkbox');
            
            // Cookie expiration time (1 year)
            const cookieExpiration = 365;
            
            // Check if cookie consent is already given
            const consentCookie = getCookie('cookie_consent');
            
            if (!consentCookie) {
                // Show the cookie banner if no consent cookie exists
                cookieBanner.style.display = 'flex'; // Изменено с 'block' на 'flex' для центрирования
            } else {
                // Apply saved consent preferences
                applyConsentPreferences(JSON.parse(consentCookie));
            }
            
            // Event listeners
            settingsBtn.addEventListener('click', function() {
                cookieSettingsModal.style.display = 'flex';
                
                // Load saved preferences if they exist
                const savedPreferences = getCookie('cookie_consent');
                if (savedPreferences) {
                    const preferences = JSON.parse(savedPreferences);
                    analyticsCheckbox.checked = preferences.analytics || false;
                    marketingCheckbox.checked = preferences.marketing || false;
                }
            });
            
            closeSettingsBtn.addEventListener('click', function() {
                cookieSettingsModal.style.display = 'none';
            });
            
            acceptAllBtn.addEventListener('click', function() {
                const preferences = {
                    necessary: true,
                    analytics: true,
                    marketing: true
                };
                
                setConsentCookie(preferences);
                hideBanner();
            });
            
            rejectAllBtn.addEventListener('click', function() {
                const preferences = {
                    necessary: true,
                    analytics: false,
                    marketing: false
                };
                
                setConsentCookie(preferences);
                hideBanner();
            });
            
            savePreferencesBtn.addEventListener('click', function() {
                cookieSettingsModal.style.display = 'flex';
            });
            
            saveSettingsBtn.addEventListener('click', function() {
                const preferences = {
                    necessary: true,
                    analytics: analyticsCheckbox.checked,
                    marketing: marketingCheckbox.checked
                };
                
                setConsentCookie(preferences);
                cookieSettingsModal.style.display = 'none';
                hideBanner();
            });
            
            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === cookieSettingsModal) {
                    cookieSettingsModal.style.display = 'none';
                }
            });
            
            // Helper functions
            function getCookie(name) {
                const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
                return match ? match[2] : null;
            }
            
            function setCookie(name, value, days) {
                let expires = '';
                
                if (days) {
                    const date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = '; expires=' + date.toUTCString();
                }
                
                document.cookie = name + '=' + value + expires + '; path=/; SameSite=Lax';
            }
            
            function setConsentCookie(preferences) {
                setCookie('cookie_consent', JSON.stringify(preferences), cookieExpiration);
                applyConsentPreferences(preferences);
            }
            
            function hideBanner() {
                cookieBanner.style.display = 'none';
            }
            
            function applyConsentPreferences(preferences) {
                // Используем gtag API для обновления согласий
                window.dataLayer = window.dataLayer || [];
                function gtag(){window.dataLayer.push(arguments);}
                
                // Обновляем настройки согласия
                gtag('consent', 'update', {
                    'analytics_storage': preferences.analytics ? 'granted' : 'denied',
                    'ad_storage': preferences.marketing ? 'granted' : 'denied',
                    'functionality_storage': preferences.necessary ? 'granted' : 'denied',
                    'personalization_storage': preferences.marketing ? 'granted' : 'denied',
                    'ad_user_data': preferences.marketing ? 'granted' : 'denied',
                    'ad_personalization': preferences.marketing ? 'granted' : 'denied'
                });
                
                // Также отправляем событие для отслеживания
                window.dataLayer.push({
                    'event': 'consent_update',
                    'consent_settings': preferences
                });
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/lenis@1.3.4/dist/lenis.min.js"></script>
    <script src="https://kit.fontawesome.com/2c09f7fb88.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}?v={{ $version }}"></script>
    <script src="{{ asset('js/additional.js') }}?v={{ $version }}"></script>
    @stack('scripts')
</body>

</html>