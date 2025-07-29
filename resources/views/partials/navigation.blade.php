<nav class="nav">
    <div class="nav__top-bar"></div>
    <div class="nav__phone only-phone">
        <a href="{{ route('home', app()->getLocale()) }}" class="logo__link">
            <img src="{{ asset('assets/m1-logo-light.svg') }}?v={{ time() }}" alt="">
        </a>
        <span id="nav_open">{{ __('Menu') }}</span>
    </div>
    <div class="nav__content">
        <div class="nav__left">
            <div class="nav__logo">
                <a href="{{ route('home', app()->getLocale()) }}" class="logo__link">
                    <img src="{{ asset('assets/m1-logo-light.svg') }}?v={{ time() }}" alt="">
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
                        <a href="{{ route('page', ['locale' => app()->getLocale(), 'slug' => 'about']) }}" class="nav__link nav__link_full">
                            <span class="underline-anim">{{ __('About Us') }}</span>
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('news.index', app()->getLocale()) }}" class="nav__link">
                            <span class="underline-anim">{{ __('News') }}</span>
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>
        <div class="nav__actions">
            <div class="language-switcher">
                @php
                    $currentLocale = app()->getLocale();
                    $availableLocales = config('app.available_locales', ['en', 'lv']);
                    $currentRoute = request()->route()->getName();
                    $currentParams = request()->route()->parameters();
                    unset($currentParams['locale']);
                @endphp
                
                {{-- Десктоп версия - с выпадающим меню --}}
                <div class="language-dropdown only-desktop">
                    <button class="language-current">
                        {{ strtoupper($currentLocale) }}
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="language-options">
                        @foreach($availableLocales as $locale)
                            @if($locale !== $currentLocale)
                                <a href="{{ route($currentRoute, array_merge(['locale' => $locale], $currentParams)) }}" class="language-option">
                                    {{ strtoupper($locale) }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                
                {{-- Мобильная версия - только неактивный язык --}}
                <div class="language-mobile only-phone">
                    @foreach($availableLocales as $locale)
                        @if($locale !== $currentLocale)
                            <a href="{{ route($currentRoute, array_merge(['locale' => $locale], $currentParams)) }}" class="language-link">
                                {{ strtoupper($locale) }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
            <a href="{{ route('page', ['locale' => app()->getLocale(), 'slug' => 'contact']) }}" class="button arrow-btn">
                <span>{{ __('Contact') }}</span>
                <div class="i_bg">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </a>
        </div>
    </div>
</nav>

<div class="nav__overlay"></div>

@php
    // Получаем страницы решений
    $solutionPages = \App\Models\Page::where('type', 'solution')->active()->ordered()->get();
@endphp

<section class="nav__submenu" id="nav_solutions">
    <p class="submenu__title">{{ __('Solutions') }}</p>
    <div class="submenu__cards">
        @foreach($solutionPages as $solution)
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

<!-- <section class="nav__submenu" id="nav_about">
    <p class="submenu__title">{{ __('About us') }}</p>
    <div class="submenu__cards">
        <div class="submenu__card">
            <a href="{{ route('page', ['locale' => app()->getLocale(), 'slug' => 'about']) }}">
                <div class="submenu__preview">
                    <i class="fas fa-arrow-right submenu__icon"></i>
                    <img src="{{ asset('assets/about_previews/who_we_are.png') }}" class="submenu__img">
                </div>
                <p class="submenu__subtitle">{{ __('Who we are') }}</p>
            </a>
        </div>
        <div class="submenu__card">
            <a href="{{ route('page', ['locale' => app()->getLocale(), 'slug' => 'how-we-work']) }}">
                <div class="submenu__preview">
                    <i class="fas fa-arrow-right submenu__icon"></i>
                    <img src="{{ asset('assets/about_previews/how_we_work.png') }}" class="submenu__img">
                </div>
                <p class="submenu__subtitle">{{ __('How we work') }}</p>
            </a>
        </div>
    </div>
</section> -->