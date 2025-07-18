@extends('layouts.app')

@section('content')
    <header class="header">
        <div class="header__content">
            <h1 class="header__title">{{ $page->hero_title ?? 'Charging solutions' }}</h1>
        </div>
    </header>

    @php
        $content = $page->content;
    @endphp

    <section class="solutions">
        <p class="solutions__title">{{ $content['pick_use_case_title'] ?? 'Pick your use case' }}</p>
        <div class="solutions__cards">
            @foreach($solutions as $solution)
                <div class="solutions__card solution">
                    <a href="{{ route('solution', ['locale' => app()->getLocale(), 'slug' => $solution->slug]) }}">
                        <div class="solution__img-wrapper">
                            <img class="solution__img" src="{{ asset('assets/solutions-page/previews/' . $solution->slug . '.png') }}" 
                                 alt="{{ $solution->title }}">
                        </div>
                        <p class="solution__title">{{ $solution->title }}</p>
                        <i class="fas fa-arrow-right solution__icon"></i>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/solutions.css') }}">
        <style>
            .header__title, .header__subtitle, .header__note, .header__note i {
                color: #000!important;
            }
            header {
                width: 100%;
                min-height: 30vh;
                position: relative;
            }
        </style>
    @endpush
@endsection