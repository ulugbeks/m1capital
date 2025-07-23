@extends('layouts.app')

@section('content')
    <header class="header">
        <div class="header__content">
            <h1 class="header__title">{{ $solution->hero_title ?? $solution->title }}</h1>
            <button class="header__button circleBg-btn">
                <a href="{{ route('page', ['locale' => app()->getLocale(), 'slug' => 'contact']) }}">
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
        $translation = $solution->translate(app()->getLocale());
    @endphp

    @if($translation->rellax_image)
    <div class="rellax-wrapper">
        <div class="clip-mask">
            <div class="rellax" data-rellax-speed="-3">
                <img src="{{ asset('storage/' . $translation->rellax_image) }}" />
            </div>
        </div>
    </div>
    @endif

    <div class="section-grid info">
        <div class="info__description section-description">
            <h3 class="info__title">{{ $content['info']['title'] ?? '' }}</h3>
            <a href="{{ route('page', ['locale' => app()->getLocale(), 'slug' => 'contact']) }}" class="section-subtitle underline-anim">{{ $content['info']['link_text'] ?? 'Ready to get started? Contact us' }}</a>
            <div class="info__content">
                {!! $content['info']['content'] ?? '' !!}
            </div>
        </div>
        @if($translation->info_image)
            <img src="{{ asset('storage/' . $translation->info_image) }}" class="info__img">
        @endif
    </div>

    <section class="deliver">
        <h2 class="deliver__title">{{ $content['deliver']['title'] ?? 'The benefits for your residents:' }}</h2>
        <div class="number-grid" id="deliver-grid">
            @foreach($content['deliver']['items'] ?? [] as $index => $item)
                @if(!empty($item['subtitle']) || !empty($item['text']))
                <div class="number-card">
                    @if(isset($item['image']) && $item['image'])
                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['subtitle'] ?? '' }}">
                    @else
                        <img src="{{ asset('assets/placeholder.jpg') }}" alt="{{ $item['subtitle'] ?? '' }}">
                    @endif
                    <div class="number-card__info">
                        <div class="number-card__id">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                        <h3 class="number-card__title">{{ $item['subtitle'] ?? '' }}</h3>
                        <p class="number-card__text">{{ $item['text'] ?? '' }}</p>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </section>

    @if($translation->rellax_mini_image)
    <div class="rellax-wrapper mini">
        <div class="clip-mask">
            <div class="rellax" data-rellax-speed="-3">
                <img src="{{ asset('storage/' . $translation->rellax_mini_image) }}" />
            </div>
        </div>
    </div>
    @endif

    <section class="get-started">
        <h2 class="get-started__title">{!! $content['get_started']['title'] ?? 'Ready to get <br> started?' !!}</h2>
        <button class="circleBg-btn get-started__button">
            <a href="{{ route('page', ['locale' => app()->getLocale(), 'slug' => 'contact']) }}">
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

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/solution.css') }}">
        <link rel="stylesheet" href="{{ asset('css/number-grid.css') }}">
        <style>
            .header__title, .header__subtitle, .header__note, .header__note i {
                color: #000!important;
            }
        </style>
    @endpush

    @push('scripts')
        @if($translation->rellax_image || $translation->rellax_mini_image)
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rellax/1.12.1/rellax.min.js"></script>
        <script>
            // Инициализация Rellax
            var rellax = new Rellax('.rellax');
        </script>
        @endif
        <script src="{{ asset('js/additional.js') }}"></script>
    @endpush
@endsection