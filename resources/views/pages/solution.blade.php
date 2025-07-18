@extends('layouts.app')

@section('content')
    <header class="header">
        <div class="header__content">
            <h1 class="header__title">{{ $solution->hero_title ?? $solution->title }}</h1>
            <button class="header__button circleBg-btn">
                <a href="{{ route('contact', ['locale' => app()->getLocale(), 'slug' => 'contact']) }}">
                    <span>{{ $content['button_text'] ?? 'Contact us' }}</span>
                    <div class="_i_bg"></div>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </button>
            <h3 class="header__subtitle">{{ $solution->hero_subtitle ?? '' }}</h3>
        </div>
        <p class="header__note">{{ $content['explore_text'] ?? 'Explore' }} <i class="fas fa-arrow-down"></i></p>
    </header>

    @php
        $content = $solution->content;
    @endphp

    @if(isset($content['show_rellax']) && $content['show_rellax'])
    <div class="rellax-wrapper">
        <div class="clip-mask">
            <div class="rellax" data-rellax-speed="-3">
                <img src="{{ asset('assets/solutions-page/apartment-buildings/1.png') }}" />
            </div>
        </div>
    </div>
    @endif

    <div class="section-grid info">
        <div class="info__description section-description">
            <h3 class="info__title">{{ $content['info']['title'] ?? '' }}</h3>
            <a href="{{ route('contact', ['locale' => app()->getLocale(), 'slug' => 'contact']) }}" class="section-subtitle underline-anim">
                {{ $content['info']['link_text'] ?? 'Ready to get started? Contact us' }}
            </a>
            <div class="section-text">
                {!! $content['info']['content'] ?? '' !!}
            </div>
        </div>
        @if(isset($content['info']['show_image']) && $content['info']['show_image'])
            <img src="{{ asset('assets/solutions/' . $solution->slug . '/2.png') }}" class="info__img">
        @endif
    </div>

    @if(isset($content['deliver']['items']) && count($content['deliver']['items']) > 0)
    <section class="deliver">
        <h2 class="deliver__title">{{ $content['deliver']['title'] ?? 'What we deliver:' }}</h2>
        <div class="deliver__grid">
            @foreach($content['deliver']['items'] ?? [] as $index => $item)
                <div class="deliver__item">
                    @if(isset($content['deliver']['show_numbers']) && $content['deliver']['show_numbers'])
                        <div class="deliver__number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                    @endif
                    <div class="deliver__content">
                        <h3 class="section-subtitle">{{ $item['subtitle'] ?? '' }}</h3>
                        <p class="section-text">{{ $item['text'] ?? '' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif

    @if(isset($content['benefits']) && count($content['benefits']['items'] ?? []) > 0)
    <section class="benefits">
        <h2 class="benefits__title">{{ $content['benefits']['title'] ?? 'Key Benefits' }}</h2>
        <div class="benefits__grid">
            @foreach($content['benefits']['items'] ?? [] as $benefit)
                <div class="benefit-item">
                    <h3 class="benefit-item__title">{{ $benefit['title'] ?? '' }}</h3>
                    <p class="benefit-item__text">{{ $benefit['text'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </section>
    @endif

    @if(isset($content['show_rellax_mini']) && $content['show_rellax_mini'])
    <div class="rellax-wrapper mini">
        <div class="clip-mask">
            <div class="rellax" data-rellax-speed="-3">
                <img src="{{ asset('assets/solutions/' . $solution->slug . '/3.png') }}" />
            </div>
        </div>
    </div>
    @endif

    @if($products->count() > 0)
    <section class="products">
        <div class="section-grid">
            <p>{{ $content['products']['subtitle'] ?? 'Our products' }}</p>
            <h2>{{ $content['products']['title'] ?? 'We offer a range of compatible solutions.' }}</h2>
        </div>
        <div class="products-slider drag-slider swiper">
            <div class="swiper-wrapper">
                @foreach($products as $product)
                    <div class="swiper-slide product-card" data-product="{{ $product->key }}">
                        <div class="product-card__preview">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}">
                            @endif
                        </div>
                        <h3 class="product-card__title">{{ $product->title }}</h3>
                        <p class="product-card__subtitle">{{ $product->subtitle }}</p>
                        <button class="product-card__button">{{ __('View details') }}</button>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>
    @endif

    @if(isset($content['faq']['items']) && count($content['faq']['items']) > 0)
    <section class="notsure">
        <h2 class="notsure__title">{!! $content['faq']['title'] ?? 'Got a question?' !!}</h2>
        <p class="notsure__subtitle">{{ $content['faq']['subtitle'] ?? 'Frequently asked questions' }}</p>
        <div class="questions-grid">
            @foreach($content['faq']['items'] ?? [] as $index => $item)
                @if(!empty($item['question']))
                <div class="question-item" data-index="{{ $index }}">
                    <div class="question-item__header">
                        <h3 class="question-item__title">{{ $item['question'] }}</h3>
                        <i class="fas fa-plus question-item__icon"></i>
                    </div>
                    <div class="question-item__content">
                        <div class="question-item__answer">
                            {!! $item['answer'] ?? '' !!}
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </section>
    @endif

    <section class="get-started">
        <h2 class="get-started__title">{!! $content['get_started']['title'] ?? 'Ready to get <br> started?' !!}</h2>
        <button class="circleBg-btn get-started__button">
            <a href="{{ route('contact', ['locale' => app()->getLocale(), 'slug' => 'contact']) }}">
                <span>{{ $content['get_started']['button_text'] ?? 'Contact us' }}</span>
                <div class="_i_bg"></div>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </button>
        <div class="get-started__description">
            <div class="section-subtitle">{{ $content['get_started']['subtitle'] ?? 'EV charging solutions for residential sites and businesses.' }}</div>
            <div class="section-text">{!! $content['get_started']['text'] ?? 'We\'ll listen to your needs, identify the best approach, and then <br> create a bespoke smart EV charging solution that\'s right for you.' !!}</div>
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

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/solution.css') }}">
        <style>
            .header__title, .header__subtitle, .header__note, .header__note i {
                color: #000!important;
            }
        </style>
    @endpush

    @push('scripts')
        @if((isset($content['show_rellax']) && $content['show_rellax']) || (isset($content['show_rellax_mini']) && $content['show_rellax_mini']))
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rellax/1.12.1/rellax.min.js"></script>
        @endif
        <script src="{{ asset('js/additional.js') }}"></script>
        <script>
            // Данные продуктов для модального окна
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

            @if((isset($content['show_rellax']) && $content['show_rellax']) || (isset($content['show_rellax_mini']) && $content['show_rellax_mini']))
            // Инициализация Rellax
            var rellax = new Rellax('.rellax');
            @endif

            // Инициализация слайдера продуктов
            @if($products->count() > 0)
            const swiper = new Swiper('.products-slider', {
                slidesPerView: 'auto',
                spaceBetween: 30,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                },
            });
            @endif

            // Инициализация FAQ
            document.querySelectorAll('.question-item').forEach(item => {
                item.addEventListener('click', function() {
                    this.classList.toggle('active');
                    const icon = this.querySelector('.question-item__icon');
                    icon.classList.toggle('fa-plus');
                    icon.classList.toggle('fa-minus');
                });
            });

            // Обработчик клика по продукту
            document.querySelectorAll('.product-card').forEach(card => {
                card.addEventListener('click', function() {
                    const productKey = this.getAttribute('data-product');
                    const product = productsData[productKey];
                    
                    if (product) {
                        // Заполняем модальное окно
                        const modal = document.querySelector('.product-modal');
                        modal.querySelector('.product-modal__preview img').src = product.image;
                        modal.querySelector('.product-modal__title').textContent = product.title;
                        modal.querySelector('.product-modal__text').textContent = product.description;
                        
                        // Заполняем features
                        const featuresList = modal.querySelector('#modal_features');
                        featuresList.innerHTML = '';
                        product.features.forEach(feature => {
                            const li = document.createElement('li');
                            li.textContent = feature;
                            featuresList.appendChild(li);
                        });
                        
                        // Заполняем applications
                        const applicationsList = modal.querySelector('#modal_applications');
                        applicationsList.innerHTML = '';
                        product.applications.forEach(app => {
                            const li = document.createElement('li');
                            li.textContent = app;
                            applicationsList.appendChild(li);
                        });
                        
                        // Показываем модальное окно
                        modal.classList.remove('hidden');
                    }
                });
            });

            // Закрытие модального окна
            document.querySelector('#modal_closeHandler').addEventListener('click', function() {
                document.querySelector('.product-modal').classList.add('hidden');
            });
        </script>
    @endpush
@endsection