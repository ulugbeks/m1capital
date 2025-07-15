<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/language-switcher.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/medias.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $page->meta_title ?? $page->title ?? config('app.name'))</title>
    <meta name="description" content="@yield('description', $page->meta_description ?? '')">
    <meta name="keywords" content="@yield('keywords', $page->meta_keywords ?? '')">
    
    @stack('styles')
</head>

<body>
    <div class="start-frame"></div>

    @include('partials.navigation')

    @yield('content')

    @include('partials.footer')

    @stack('modals')

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/lenis@1.3.4/dist/lenis.min.js"></script>
    <script src="https://kit.fontawesome.com/2c09f7fb88.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}?v={{ time() }}"></script>
    @stack('scripts')
</body>

</html>