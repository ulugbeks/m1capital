@extends('layouts.app')

@section('content')
    <header class="header">
        <div class="header__content">
            <h1 class="header__title">{{ $page->hero_title ?? 'Charging solutions' }}</h1>
        </div>
    </header>

    @php
        $content = $page->content;
        $solutionsContent = $content['solutions'] ?? [];
    @endphp

    <section class="solutions">
        <p class="solutions__title">{{ $content['pick_use_case_title'] ?? 'Pick your use case' }}</p>
        
        <div class="solutions__grid">
            @foreach($solutions as $index => $solution)
                @php
                    $isEven = $index % 2 === 0;
                    $cardContent = $solutionsContent[$solution->slug] ?? [];
                    $cardTitle = $cardContent['card_title'] ?? '';
                    $cardText = $cardContent['card_text'] ?? '';
                @endphp
                
                <div class="solution-row {{ $isEven ? 'solution-row--normal' : 'solution-row--reversed' }}">
                    <div class="solution-card">
                        <a href="{{ route('solution', ['locale' => app()->getLocale(), 'slug' => $solution->slug]) }}" class="solution-card__link">
                            <div class="solution-card__image">
                                <img src="{{ asset('assets/solutions-page/previews/' . $solution->slug . '.png') }}" 
                                     alt="{{ $solution->title }}">
                                <div class="solution-card__overlay">
                                    <h3 class="solution-card__title">{{ $solution->title }}</h3>
                                    <i class="fas fa-arrow-right solution-card__icon"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="solution-content">
                        @if($cardTitle)
                            <h2 class="solution-content__title">{{ $cardTitle }}</h2>
                        @endif
                        @if($cardText)
                            <p class="solution-content__text">{{ $cardText }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/solutions.css') }}">
        <style>
            .header__title {
                color: #000!important;
            }
            
            header {
                width: 100%;
                min-height: 30vh;
                position: relative;
            }
            
            .solutions {
                padding: 80px 5%;
                margin: 0 auto;
            }
            
            .solutions__title {
                font-size: 48px;
                font-weight: 600;
                margin-bottom: 80px;
                text-align: center;
                color: #1a1a1a;
            }
            
            .solutions__grid {
                display: flex;
                flex-direction: column;
                gap: 80px;
            }
            
            /* Строка с решением */
            .solution-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 60px;
                align-items: center;
            }
            
            .solution-row--reversed {
                direction: rtl;
            }
            
            .solution-row--reversed > * {
                direction: ltr;
            }
            
            /* Карточка решения */
            .solution-card {
                position: relative;
                overflow: hidden;
                border-radius: 20px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            
            .solution-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            }
            
            .solution-card__link {
                display: block;
                text-decoration: none;
            }
            
            .solution-card__image {
                position: relative;
                width: 100%;
                height: 400px;
                overflow: hidden;
            }
            
            .solution-card__image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s ease;
            }
            
            .solution-card:hover .solution-card__image img {
                transform: scale(1.05);
            }
            
            .solution-card__overlay {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                padding: 30px;
                background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
                color: white;
            }
            
            .solution-card__title {
                font-size: 28px;
                font-weight: 600;
                margin-bottom: 10px;
                color: #fff;
            }
            
            .solution-card__icon {
                position: absolute;
                right: 20px;
                transform: translateY(-100%);
                padding: 20px 21px;
                border-radius: 50%;
                background: var(--color-accent);
                transition: 300ms ease;
                clip-path: ellipse(50% 50% at 50% 50%);
            }
            
            .solution-card:hover .solution-card__icon {
                opacity: 1;
                clip-path: ellipse(40% 40% at 50% 50%);
            }
            
            /* Контент решения */
            .solution-content {
                padding: 20px;
            }
            
            .solution-content__title {
                font-size: 36px;
                font-weight: 700;
                margin-bottom: 20px;
                color: #1a1a1a;
                line-height: 1.2;
            }
            
            .solution-content__text {
                font-size: 18px;
                line-height: 1.8;
                color: #666;
            }
            
            /* Адаптивность */
            @media (max-width: 1024px) {
                .solutions__grid {
                    gap: 60px;
                }
                
                .solution-row {
                    gap: 40px;
                }
                
                .solution-card__image {
                    height: 350px;
                }
                
                .solution-content__title {
                    font-size: 30px;
                }
            }
            
            @media (max-width: 768px) {
                .solutions {
                    padding: 60px 5%;
                }
                
                .solutions__title {
                    font-size: 36px;
                    margin-bottom: 60px;
                }
                
                .solution-row,
                .solution-row--reversed {
                    grid-template-columns: 1fr;
                    direction: ltr;
                    gap: 30px;
                }
                
                .solution-card__image {
                    height: 300px;
                }
                
                .solution-card__title {
                    font-size: 24px;
                }
                
                .solution-content {
                    padding: 0;
                }
                
                .solution-content__title {
                    font-size: 26px;
                }
                
                .solution-content__text {
                    font-size: 16px;
                }
                header {
                    min-height: 15vh;
                }
            }
            
            @media (max-width: 480px) {
                .solutions__title {
                    font-size: 28px;
                }
                
                .solution-card__image {
                    height: 250px;
                }
                
                .solution-card__title {
                    font-size: 20px;
                }
                
                .solution-card__overlay {
                    padding: 20px;
                }
                
                .solution-content__title {
                    font-size: 22px;
                }
                
                .solution-content__text {
                    font-size: 14px;
                }
            }
        </style>
    @endpush
@endsection