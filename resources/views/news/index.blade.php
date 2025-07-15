@extends('layouts.app')

@section('content')
    <header class="header">
        <div class="header__content">
            <h1 class="header__title">{{ $page->hero_title ?? 'Latest news' }}</h1>
            <h3 class="header__subtitle section-text">{{ $page->hero_subtitle ?? 'All the latest news and articles from Energy Park.' }}</h3>
        </div>
    </header>

    <section class="news">
        <div class="news__wrapper">
            @foreach($news as $article)
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
                            @if($article->excerpt)
                                <p class="news-item__excerpt">{{ $article->excerpt }}</p>
                            @endif
                            <span class="news-item__link">{{ __('Read more') }} <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
        
        <div class="news__pagination">
            {{ $news->links() }}
        </div>
    </section>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/news.css') }}">
    @endpush
@endsection