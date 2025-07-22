@extends('layouts.app')

@section('title', $news->meta_title ?: $news->title)
@section('description', $news->meta_description ?: Str::limit(strip_tags($news->content), 160))

@section('content')
    <header class="header">
        <div class="header__content">
            <h1 class="header__title">{{ $news->title }}</h1>
            <h3 class="header__subtitle section-text">{{ $news->published_at->format('jS F Y') }}</h3>
        </div>
    </header>

    <main class="new-content">
        @if($news->image)
            <img class="new-content__img" src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}">
        @endif
        <div class="new-content__text">
            {!! $news->content !!}
        </div>
    </main>

    <section class="get-started">
        <h2 class="get-started__title">{!! __('Ready to get <br> started?') !!}</h2>
        <button class="circleBg-btn get-started__button">
            <a href="{{ route('page', ['locale' => app()->getLocale(), 'slug' => 'contact']) }}">
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

    @if($relatedNews->count() > 0)
        <section class="related-news">
            <h2>{{ __('Related news') }}</h2>
            <div class="news__wrapper">
                @foreach($relatedNews as $article)
                    <article class="news-item">
                        <a href="{{ route('news.show', ['locale' => app()->getLocale(), 'news' => $article]) }}">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="news-item__img">
                            @else
                                <div class="news-item__img news-item__img--placeholder">
                                    <span>{{ __('No image') }}</span>
                                </div>
                            @endif
                            <div class="news-item__content">
                                <time class="news-item__date">{{ $article->published_at->format('jS F Y') }}</time>
                                <h3 class="news-item__title">{{ $article->title }}</h3>
                                <span class="news-item__link">{{ __('Read more') }} <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/new.css') }}">
        <style>
            .header__title, .header__subtitle, .header__note, .header__note i {
                color: #000!important;
            }
        </style>
    @endpush
@endsection