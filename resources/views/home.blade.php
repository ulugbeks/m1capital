@extends('layouts.app')

@section('content')
    <header class="header">
        <video src="{{ asset('assets/index/header-bg.mp4') }}" autoplay loop muted class="header__bg"></video>
        <div class="header__content">
            <h1 class="header__title">{{ $page->hero_title ?? 'Get set for an electric future' }}</h1>
            <button class="header__button circleBg-btn">
                <a href="{{ route('solutions', app()->getLocale()) }}">
                    <span>{{ __('Our solutions') }}</span>
                    <div class="_i_bg"></div>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </button>
            <h3 class="header__subtitle">{{ $page->hero_subtitle ?? 'Powering peace of mind through tailored EV charging solutions.' }}</h3>
        </div>
        <p class="header__note">{{ __('Explore') }} <i class="fas fa-arrow-down"></i></p>
    </header>

    @php
        $content = $page->content;
    @endphp

    <section class="future-proof">
        <h2 class="future-proof__title">{{ $content['future_proof']['title'] ?? 'Future-proof your residential site or business with our scalable EV charging solutions' }}</h2>
        <img class="future-proof__img" src="{{ asset('assets/index/future-proof.png') }}">
    </section>

    <section class="solutions">
        <p class="solutions__title">{{ __('Charging solutions for') }}</p>
        <div class="solutions__items">
            @foreach($content['solutions'] ?? [] as $index => $solution)
            <a href="{{ route('solution', ['locale' => app()->getLocale(), 'slug' => $solution['slug'] ?? '']) }}" class="solution">
                <div class="solution__left">
                    <span class="solution__number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <span class="solution__text">{{ $solution['title'] ?? '' }}</span>
                </div>
                <i class="fas fa-arrow-right"></i>
            </a>
            @endforeach
        </div>
    </section>

    <section class="help">
        <div class="only-phone help__full-text">
            @foreach($content['help']['items'] ?? [] as $item)
            <div class="section-description">
                <p class="section-subtitle">{{ $item['number'] ?? '' }}. {{ $item['title'] ?? '' }}</p>
                <p class="section-text">{{ $item['description'] ?? '' }}</p>
            </div>
            @endforeach
        </div>
        <div class="help__slider">
            <img src="{{ asset('assets/help_slides/expertise.png') }}" class="help__slide active" data-tab="expertise">
            <img src="{{ asset('assets/help_slides/guidance.png') }}" class="help__slide" data-tab="guidance">
            <img src="{{ asset('assets/help_slides/support.png') }}" class="help__slide" data-tab="support">
        </div>
        <div class="help__info">
            <p class="help__title">{{ $content['help']['title'] ?? 'How we can help' }}</p>
            <ul class="help__links">
                @foreach($content['help']['tabs'] ?? [] as $tab)
                <li class="help__link" data-tab="{{ $tab['key'] ?? '' }}">
                    {{ $tab['title'] ?? '' }}
                </li>
                @endforeach
            </ul>
            <div class="help__description">
                <div class="help__subtitle section-subtitle">{{ $content['help']['default_subtitle'] ?? 'A consultative approach' }}</div>
                <div class="help__text section-text">{{ $content['help']['default_text'] ?? '' }}</div>
            </div>
        </div>
    </section>

    <section class="solutions-ad">
        <div class="solutions-ad__content">
            <h2 class="solutions-ad__title">{!! $content['solutions_ad']['title'] ?? 'Smart EV charging solutions <br> for residential sites and business' !!}</h2>
            <button class="solutions-ad__button circleBg-btn">
                <a href="{{ route('solutions', app()->getLocale()) }}">
                    <span>{{ __('Our solutions') }}</span>
                    <div class="_i_bg"></div>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </button>
        </div>
    </section>

    <section class="products">
        <div class="section-grid">
            <p></p>
            <h2 class="products__title">{{ $content['products']['title'] ?? 'We offer a range of charge points to choose from.' }}</h2>
        </div>
        <div class="products-slider drag-slider swiper">
            <div class="swiper-wrapper" id="products-wrapper">
                <!-- Products will be loaded here -->
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>

    <section class="partners">
        <div class="section-grid">
            <p class="partners__subtitle">{{ $content['partners']['subtitle'] ?? 'We partner with the best.' }}</p>
            <h2 class="partners__title">{!! $content['partners']['title'] ?? 'Working with leading <br> equipment manufacturers <br> gives us access to a wide <br> range of hardware solutions.' !!}</h2>
        </div>
        <div class="partners__slider swiper">
            <div class="swiper-wrapper" id="partners-wrapper">
                <!-- Partners will be loaded here -->
            </div>
        </div>
        <div class="section-grid partners__info">
            <p>{{ __('Drag slider') }}</p>
            <div class="partners__description">
                <p class="section-subtitle">{{ $content['partners']['description_subtitle'] ?? 'EV charging solutions for residential sites and businesses' }}</p>
                <p class="section-text">{{ $content['partners']['description_text'] ?? '' }}</p>
            </div>
        </div>
    </section>

    <section class="get-started">
        <h2 class="get-started__title">{!! $content['get_started']['title'] ?? 'Ready to get <br> started?' !!}</h2>
        <button class="circleBg-btn get-started__button">
            <a href="{{ route('contact', ['locale' => app()->getLocale(), 'slug' => 'contact']) }}">
                <span>{{ __('Contact us') }}</span>
                <div class="_i_bg"></div>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </button>
        <div class="get-started__description">
            <div class="section-subtitle">{{ $content['get_started']['subtitle'] ?? 'EV charging solutions for residential sites and businesses.' }}</div>
            <div class="section-text">{!! $content['get_started']['text'] ?? "We'll listen to your needs, identify the best approach, and then <br> create a bespoke smart EV charging solution that's right for you." !!}</div>
        </div>
    </section>

    @push('modals')
    <div class="product-modal hidden" data-lenis-prevent>
        <div class="product-modal__preview">
            <img src="/">
        </div>
        <div class="product-modal__info">
            <h2 class="product-modal__title"></h2>
            <h3 class="product-modal__subtitle">{{ __('Product description') }}</h3>
            <p class="product-modal__text"></p>
            <hr>
            <div class="product-modal__block">
                <h3 class="product-modal__subtitle">{{ __('Features') }}</h3>
                <ul class="product-modal__list" id="modal_features">
                </ul>
            </div>
            <hr>
            <div class="product-modal__block">
                <h3 class="product-modal__subtitle">{{ __('Applications') }}</h3>
                <ul class="product-modal__list" id="modal_applications">
                </ul>
            </div>
        </div>
        <div id="modal_closeHandler">
            <i class="product-modal__close fas fa-xmark"></i>
        </div>
    </div>
    @endpush

    @push('scripts')
    <script>
        // Данные продуктов из базы
        const productsData = {
            @foreach($products as $product)
            '{{ $product->key }}': {
                'title': '{{ $product->title }}',
                'subtitle': '{{ $product->subtitle }}',
                'description': `{!! str_replace("\n", "\\n", addslashes($product->description)) !!}`,
                'manufacturers_standard': '{{ $product->manufacturers_standard }}',
                'features': @json($product->features ?? []),
                'applications': @json($product->applications ?? []),
                'image': '{{ $product->image ? asset("storage/" . $product->image) : "" }}'
            },
            @endforeach
        };
        
        // Данные партнеров из базы
        const partnersData = {
            @foreach($partners->groupBy('category') as $category => $categoryPartners)
            '{{ $category }}': @json($categoryPartners->map(function($partner) {
                return [
                    'name' => $partner->name,
                    'logo' => asset('storage/' . $partner->logo)
                ];
            })),
            @endforeach
        };
        
        // Данные для вкладок help
        const helpTabsData = {
            @foreach($content['help']['items'] ?? [] as $item)
            '{{ $item['tab_key'] ?? '' }}': {
                'title': '{{ $item['title'] ?? '' }}',
                'description': '{{ $item['description'] ?? '' }}'
            },
            @endforeach
        };
        
        // Инициализация слайдеров и компонентов
        document.addEventListener('DOMContentLoaded', function() {
            // Инициализация продуктов
            if (window.initProductsSlider) {
                window.initProductsSlider(productsData, '.products-slider');
            }
            
            // Инициализация партнеров
            if (window.initPartnersSlider) {
                window.initPartnersSlider(partnersData);
            }
            
            // Инициализация help tabs
            if (window.initHelpTabs) {
                window.initHelpTabs(helpTabsData);
            }
        });
    </script>
    <script src="{{ asset('js/index.js') }}"></script>
    @endpush
@endsection