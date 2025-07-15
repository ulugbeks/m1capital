@extends('layouts.app')

@section('content')
    <header class="header">
        <div class="header__content">
            <h1 class="header__title">{{ $page->hero_title ?? 'How we work' }}</h1>
        </div>
    </header>

    @php
        $content = $page->content;
    @endphp

    <section class="how-we-work">
        <div class="how-we-work__content">
            <h2 class="how-we-work__title">{{ __('How we find the best solution for you') }}</h2>
            <div class="how-we-work__steps">
                @foreach($content['steps'] ?? [] as $index => $step)
                    <div class="step">
                        <div class="step__number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="step__content">
                            <h3 class="step__title">{{ $step['title'] ?? '' }}</h3>
                            <p class="step__description">{{ $step['description'] ?? '' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="how-we-work__images">
            @foreach($content['steps'] ?? [] as $index => $step)
                <img src="{{ asset('assets/how-we-work/' . ($step['key'] ?? '') . '.png') }}" 
                     alt="{{ $step['title'] ?? '' }}" 
                     class="how-we-work__image {{ $index === 0 ? 'active' : '' }}"
                     data-step="{{ $index }}">
            @endforeach
        </div>
    </section>

    <section class="get-started">
        <h2 class="get-started__title">{!! __('Ready to get <br> started?') !!}</h2>
        <button class="circleBg-btn get-started__button">
            <a href="{{ route('contact', ['locale' => app()->getLocale(), 'slug' => 'contact']) }}">
                <span>{{ __('Contact us') }}</span>
                <div class="_i_bg"></div>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </button>
        <div class="get-started__description">
            <div class="section-subtitle">{{ __('EV charging solutions for residential sites and businesses.') }}</div>
            <div class="section-text">{!! __('We\'ll listen to your needs, identify the best approach, and then <br> create a bespoke smart EV charging solution that\'s right for you.') !!}</div>
        </div>
    </section>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/how-we-work.css') }}">
    @endpush

    @push('scripts')
        <script>
            // Анимация переключения изображений при скролле
            document.addEventListener('DOMContentLoaded', function() {
                const steps = document.querySelectorAll('.step');
                const images = document.querySelectorAll('.how-we-work__image');
                
                if (steps.length > 0 && images.length > 0) {
                    const observerOptions = {
                        root: null,
                        rootMargin: '0px',
                        threshold: 0.5
                    };
                    
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                const stepIndex = Array.from(steps).indexOf(entry.target);
                                
                                // Активируем соответствующее изображение
                                images.forEach((img, index) => {
                                    if (index === stepIndex) {
                                        img.classList.add('active');
                                    } else {
                                        img.classList.remove('active');
                                    }
                                });
                            }
                        });
                    }, observerOptions);
                    
                    steps.forEach(step => observer.observe(step));
                }
            });
        </script>
    @endpush
@endsection