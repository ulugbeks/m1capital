<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @php
        $version = config('app.version', time());
        $currentRoute = request()->route()->getName();
        $isHomePage = $currentRoute === 'home';
    @endphp
    
    <link rel="stylesheet" href="{{ asset('css/index.css') }}?v={{ $version }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v={{ $version }}">
    <link rel="stylesheet" href="{{ asset('css/solution.css') }}?v={{ $version }}">
    <link rel="stylesheet" href="{{ asset('css/language-switcher.css') }}?v={{ $version }}">
    <link rel="stylesheet" href="{{ asset('css/medias.css') }}?v={{ $version }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $page->meta_title ?? $page->title ?? config('app.name'))</title>
    <meta name="description" content="@yield('description', $page->meta_description ?? '')">
    <meta name="keywords" content="@yield('keywords', $page->meta_keywords ?? '')">
    
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v={{ $version }}">
    
    @stack('styles')
</head>

<body class="{{ $isHomePage ? 'home-page' : 'inner-page' }}" data-route="{{ $currentRoute }}">
    <div class="start-frame"></div>

    @include('partials.navigation')

    @yield('content')

    @include('partials.footer')

    @stack('modals')

    <script>
        // Передаем информацию о текущей странице в JavaScript
        window.pageInfo = {
            isHomePage: {{ $isHomePage ? 'true' : 'false' }},
            currentRoute: '{{ $currentRoute }}',
            locale: '{{ app()->getLocale() }}'
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/lenis@1.3.4/dist/lenis.min.js"></script>
    <script src="https://kit.fontawesome.com/2c09f7fb88.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}?v={{ $version }}"></script>
    <script src="{{ asset('js/additional.js') }}?v={{ $version }}"></script>
    @stack('scripts')
</body>

</html>