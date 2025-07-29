@extends('layouts.app')

@section('content')
    <header class="header">
        <img src="{{ asset('assets/about/about-1.jpeg') }}" class="about-intro" />
        <div class="header__content">
            <h1 class="header__title" style="color: #fff!important">{{ $page->hero_title }}</h1>
            <h3 class="header__subtitle">{{ $page->hero_subtitle }}</h3>
        </div>
        <p class="header__note" style="color: #fff!important">{{ __('Explore') }} <i class="fas fa-arrow-down" style="color: #fff!important"></i></p>
    </header>

    <!-- <div class="rellax-wrapper">
        <div class="clip-mask">
            <div class="rellax" data-rellax-speed="-3">
                <img src="{{ asset('assets/about/about-1.jpeg') }}" />
            </div>
        </div>
    </div> -->

    @php
        $content = $page->content;
    @endphp

    <section class="section-grid info">
        <div class="info__description section-description">
            <h3 class="info__title">{{ $content['info']['title'] ?? 'We want to make EV ownership an option for everyone.' }}</h3>
            @foreach($content['info']['paragraphs'] ?? [] as $paragraph)
                <p class="section-text">{!! $paragraph !!}</p>
            @endforeach
        </div>
        <img src="{{ asset('assets/about/about-2.jpeg') }}" class="info__img">
    </section>

    <section class="section-grid info">
        <img src="{{ asset('assets/about/beach.jpeg') }}" class="info__img">
        <div class="info__description section-description">
            <h3 class="info__title">{{ $content['info2']['title'] ?? 'We\'ll help you find the best solution for your site.' }}</h3>
            <a href="{{ route('page', ['locale' => app()->getLocale(), 'slug' => 'contact']) }}" class="section-subtitle underline-anim">{{ $content['info2']['link_text'] ?? 'How we do it' }}</a>
            @foreach($content['info2']['paragraphs'] ?? [] as $paragraph)
                <p class="section-text">{{ $paragraph }}</p>
            @endforeach
        </div>
    </section>

    <!-- <section class="team">
        <h2 class="team__title">{{ $content['team']['title'] ?? 'Meet the team' }}</h2>
        <div class="team__categories">
            @foreach($content['team']['categories'] ?? [] as $category)
                <button class="team__category" data-category="{{ $category['key'] }}">{{ $category['title'] }}</button>
            @endforeach
        </div>
        <div class="persons-slider drag-slider swiper" id="persons_slider">
            <div class="swiper-wrapper" id="persons_wrapper">
                
            </div>
        </div>
    </section> -->

    <!-- <section class="partners">
        <h2 class="partners__title">{!! $content['partners']['title'] ?? 'Our charging solutions are all <br> made possible by our partners.' !!}</h2>
        <div class="partners__wrapper">
            <div class="partners__info">
                <div class="partners__categories" data-type="partnersGrid_category">
                    @foreach($content['partners']['categories'] ?? [] as $category)
                        <button class="partners__category" data-category="{{ $category['key'] }}">{{ $category['title'] }}</button>
                    @endforeach
                </div>
                <div class="partners__description section-description">
                    <h3 class="section-subtitle"></h3>
                    <p class="section-text"></p>
                </div>
            </div>
            <div class="partners__grid" data-type="partnersGrid_imgs">
                
            </div>
        </div>
    </section> -->

    <section class="get-started">
        <h2 class="get-started__title">{!! $content['get_started']['title'] ?? 'Ready to get <br> started?' !!}</h2>
        <button class="circleBg-btn get-started__button">
            <a href="{{ route('page', ['locale' => app()->getLocale(), 'slug' => 'contact']) }}">
                <span>{{ __('Contact us') }}</span>
                <div class="_i_bg"></div>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </button>
        <div class="get-started__description">
            <div class="section-subtitle">{{ $content['get_started']['subtitle'] ?? 'EV charging solutions for residential sites and businesses.' }}</div>
            <div class="section-text">{!! $content['get_started']['text'] ?? 'We\'ll listen to your needs, identify the best approach, and then <br> create a bespoke smart EV charging solution that\'s right for you.' !!}</div>
        </div>
    </section>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/about.css') }}">
        <style>
            .header__title, .header__subtitle, .header__note, .header__note i {
                color: #000!important;
            }
            img.about-intro {
                position: absolute;
                width: 100%;
                height: 100%;
                filter: brightness(0.7);
                object-fit: cover;
            }
            @media (max-width: 576px) {
                .header__title {
                    font-size: 55px;
                    line-height: 65px;
                }
                img.about-intro {
                    object-fit: cover;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/gh/dixonandmoe/rellax@master/rellax.min.js"></script>
        <script src="{{ asset('js/additional.js') }}"></script>
        <script>
            // Данные команды из базы
            const aboutPersons = @json($teamMembers ?? []);
            const aboutPartners = @json($partnersData ?? []);
            
            initPersons(document.querySelector('.team'), aboutPersons, '/assets/persons/')
            initPartnersGrid()
        </script>
    @endpush
@endsection