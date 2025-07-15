<nav class="nav">
    <div class="nav__top-bar"></div>
    <div class="nav__phone only-phone">
        <a href="{{ route('home', app()->getLocale()) }}" class="logo__link">
            <img src="{{ asset('assets/logo_white.svg') }}" alt="">
        </a>
        <span id="nav_open">{{ __('Menu') }}</span>
    </div>
    <div class="nav__content">
        <div class="nav__left">
            <div class="nav__logo">
                <a href="{{ route('home', app()->getLocale()) }}" class="logo__link">
                    <img src="{{ asset('assets/logo_white.svg') }}" alt="">
                </a>
                <div id="nav_close" class="only-phone">{{ __('Close') }}</div>
            </div>
            <div class="nav__wrapper">
                <div class="nav__title only-phone">{{ __('Navigation') }}</div>
                <ul class="nav__links">
                    <li class="nav__item" id="nav__item_home">
                        <a href="{{ route('home', app()->getLocale()) }}" class="nav__link nav__link_full">
                            <span class="underline-anim">{{ __('Home') }}</span>
                        </a>
                    </li>
                    <li class="nav__item" id="nav_solutions_link">
                        <a href="{{ route('solutions', app()->getLocale()) }}" class="nav__link nav__link_full">
                            <span class="underline-anim">{{ __('Solutions') }}</span>
                        </a>
                    </li>
                    <li class="nav__item" id="nav_about_link">
                        <a href="{{ route('about', ['locale' => app()->getLocale(), 'slug' => 'about']) }}" class="nav__link nav__link_full">
                            <span class="underline-anim">{{ __('About Us') }}</span>
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('news.index', app()->getLocale()) }}" class="nav__link">
                            <span class="underline-anim">{{ __('News') }}</span>
                        </a>
                    </li>
                    <li class="nav__item only-phone">
                        <a href="/{{ app()->getLocale() }}/how-we-work" class="nav__link">
                            <span class="underline-anim">{{ __('How we work') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="nav__actions">
            <div class="language-switcher">
                @foreach(config('app.available_locales', ['en', 'lv']) as $locale)
                    @if($locale !== app()->getLocale())
                        <a href="{{ url($locale . '/' . (request()->segment(2) ?? '')) }}" class="lang-link">
                            {{ strtoupper($locale) }}
                        </a>
                    @endif
                @endforeach
            </div>
            <a href="{{ route('contact', ['locale' => app()->getLocale(), 'slug' => 'contact']) }}" class="button arrow-btn">
                <span>{{ __('Contact') }}</span>
                <div class="i_bg">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </a>
        </div>
    </div>
</nav>

<div class="nav__overlay"></div>

@if($solutions ?? false)
<section class="nav__submenu" id="nav_solutions">
    <p class="submenu__title">{{ __('Solutions') }}</p>
    <div class="submenu__cards">
        @foreach($solutions as $solution)
        <div class="submenu__card">
            <a href="{{ route('solution', ['locale' => app()->getLocale(), 'slug' => $solution->slug]) }}">
                <div class="submenu__preview">
                    <i class="fas fa-arrow-right submenu__icon"></i>
                    <img src="{{ asset('assets/index/solutions_previews/' . $solution->slug . '.png') }}" class="submenu__img">
                </div>
                <p class="submenu__subtitle">{{ $solution->title }}</p>
            </a>
        </div>
        @endforeach
    </div>
</section>
@endif

<section class="nav__submenu" id="nav_about">
    <p class="submenu__title">{{ __('About us') }}</p>
    <div class="submenu__cards">
        <div class="submenu__card">
            <a href="{{ route('about', ['locale' => app()->getLocale(), 'slug' => 'about']) }}">
                <div class="submenu__preview">
                    <i class="fas fa-arrow-right submenu__icon"></i>
                    <img src="{{ asset('assets/about_previews/who_we_are.png') }}" class="submenu__img">
                </div>
                <p class="submenu__subtitle">{{ __('Who we are') }}</p>
            </a>
        </div>
        <div class="submenu__card">
            <a href="/{{ app()->getLocale() }}/how-we-work">
                <div class="submenu__preview">
                    <i class="fas fa-arrow-right submenu__icon"></i>
                    <img src="{{ asset('assets/about_previews/how_we_work.png') }}" class="submenu__img">
                </div>
                <p class="submenu__subtitle">{{ __('How we work') }}</p>
            </a>
        </div>
    </div>
</section>