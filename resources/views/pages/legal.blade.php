@extends('layouts.app')

@section('content')
    <header class="header">
        <div class="header__content">
            <h1 class="header__title">{{ $page->title }}</h1>
        </div>
    </header>

    <section class="legal-content">
        <div class="container">
            <div class="legal-content__wrapper">
                {!! $page->content['main_content'] ?? '' !!}
            </div>
        </div>
    </section>

    @push('styles')
        <style>
            .header {
                min-height: 30vh;
                background: #f8f9fa;
            }
            
            .header__title {
                color: #000!important;
            }
            
            .legal-content {
                padding: 80px 0;
            }
            
            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 5%;
            }
            
            .legal-content__wrapper {
                max-width: 800px;
                margin: 0 auto;
            }
            
            .legal-content__wrapper h1,
            .legal-content__wrapper h2,
            .legal-content__wrapper h3,
            .legal-content__wrapper h4,
            .legal-content__wrapper h5,
            .legal-content__wrapper h6 {
                color: #1a1a1a;
                margin-top: 40px;
                margin-bottom: 20px;
                font-weight: 600;
            }
            
            .legal-content__wrapper h1 {
                font-size: 36px;
                line-height: 1.2;
            }
            
            .legal-content__wrapper h2 {
                font-size: 28px;
                line-height: 1.3;
            }
            
            .legal-content__wrapper h3 {
                font-size: 24px;
                line-height: 1.4;
            }
            
            .legal-content__wrapper p {
                font-size: 16px;
                line-height: 1.8;
                color: #666;
                margin-bottom: 20px;
            }
            
            .legal-content__wrapper ul,
            .legal-content__wrapper ol {
                margin-bottom: 20px;
                padding-left: 30px;
            }
            
            .legal-content__wrapper li {
                font-size: 16px;
                line-height: 1.8;
                color: #666;
                margin-bottom: 10px;
            }
            
            .legal-content__wrapper strong {
                color: #333;
                font-weight: 600;
            }
            
            .legal-content__wrapper em {
                font-style: italic;
            }
            
            .legal-content__wrapper blockquote {
                border-left: 4px solid #e0e0e0;
                padding-left: 20px;
                margin: 30px 0;
                font-style: italic;
                color: #777;
            }
            
            .legal-content__wrapper hr {
                border: none;
                border-top: 1px solid #e0e0e0;
                margin: 40px 0;
            }
            
            .legal-content__wrapper a {
                text-decoration: underline;
                transition: color 0.2s ease;
            }
            
            .legal-content__wrapper a:hover {
                color: #333;
            }
            
            .legal-content__wrapper table {
                width: 100%;
                border-collapse: collapse;
                margin: 30px 0;
            }
            
            .legal-content__wrapper table th,
            .legal-content__wrapper table td {
                border: 1px solid #e0e0e0;
                padding: 12px;
                text-align: left;
            }
            
            .legal-content__wrapper table th {
                background-color: #f8f9fa;
                font-weight: 600;
                color: #333;
            }

            .legal-content__wrapper li {
                list-style: disc;
            }
            
            @media (max-width: 768px) {
                .legal-content {
                    padding: 60px 0;
                }
                
                .legal-content__wrapper h1 {
                    font-size: 28px;
                }
                
                .legal-content__wrapper h2 {
                    font-size: 24px;
                }
                
                .legal-content__wrapper h3 {
                    font-size: 20px;
                }
                
                .legal-content__wrapper p,
                .legal-content__wrapper li {
                    font-size: 14px;
                }
            }
        </style>
    @endpush
@endsection