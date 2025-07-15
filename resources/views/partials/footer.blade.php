<footer class="footer">
    <div class="section-grid footer__top">
        <div class="footer__logo">
            <img src="{{ asset('assets/logo_black.svg') }}" alt="">
        </div>
        <div class="foooter__contacts">
            <a href="tel:{{ \App\Models\Setting::get('phone', '020 3345 3310') }}" class="underline-anim">{{ \App\Models\Setting::get('phone', '020 3345 3310') }}</a>
            <a href="mailto:{{ \App\Models\Setting::get('email', 'enquiries@energy-park.co.uk') }}" class="underline-anim">{{ \App\Models\Setting::get('email', 'enquiries@energy-park.co.uk') }}</a>
        </div>
    </div>
    <hr>
    <div class="section-grid footer__bottom">
        <div class="footer__description">
            <p>{{ \App\Models\Setting::get('footer_description', 'Experts in smart EV charging solutions <br> for residential sites and businesses.') }}</p>
        </div>
        <div class="footer__links">
            <div class="footer__column">
                <p class="footer__subtitle">{{ __('Navigation') }}</p>
                <ul class="footer__list">
                    <li class="footer__link"><a href="{{ route('about', ['locale' => app()->getLocale(), 'slug' => 'about']) }}">{{ __('About us') }}</a></li>
                    <li class="footer__link"><a href="{{ route('solutions', app()->getLocale()) }}">{{ __('Solutions') }}</a></li>
                    <li class="footer__link"><a href="{{ route('contact', ['locale' => app()->getLocale(), 'slug' => 'contact']) }}">{{ __('Contact') }}</a></li>
                </ul>
            </div>
            <div class="footer__column">
                <p class="footer__subtitle">{{ __('Follow us') }}</p>
                <ul class="footer__list">
                    <li class="footer__link"><a href="{{ \App\Models\Setting::get('linkedin', 'https://www.linkedin.com/company/energypark') }}" target="_blank">LinkedIn</a></li>
                    <li class="footer__link"><a href="{{ \App\Models\Setting::get('instagram', 'https://www.instagram.com/energy.park/') }}" target="_blank">Instagram</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer__note">
        <div class="footer__left">
            {{ date('Y') }}
        </div>
        <div class="footer__right">
            <a href="https://github.com/thisSasha" target="_blank">Site by ThisDevSasha</a>
            <button id="toTop">{{ __('Back to top') }}</button>
        </div>
    </div>
</footer>