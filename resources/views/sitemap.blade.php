<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
@foreach($urls as $url)
    <url>
        <loc>{{ $url['loc'] }}</loc>
        <lastmod>{{ $url['lastmod'] }}</lastmod>
        <changefreq>{{ $url['changefreq'] }}</changefreq>
        <priority>{{ $url['priority'] }}</priority>
        @php
            // Извлекаем текущий язык из URL
            preg_match('/\/(en|lv)\//', $url['loc'], $matches);
            $currentLocale = $matches[1] ?? 'en';
            
            // Находим альтернативные языковые версии
            $alternates = [];
            foreach($urls as $altUrl) {
                // Проверяем, что это тот же контент, но другой язык
                $pattern1 = str_replace("/{$currentLocale}/", '/([a-z]{2})/', $url['loc']);
                $pattern2 = preg_quote($url['loc'], '/');
                $pattern2 = str_replace("/{$currentLocale}/", '/([a-z]{2})/', $pattern2);
                
                if (preg_match("#{$pattern2}#", $altUrl['loc'])) {
                    preg_match('/\/(en|lv)\//', $altUrl['loc'], $altMatches);
                    $altLocale = $altMatches[1] ?? 'en';
                    $alternates[$altLocale] = $altUrl['loc'];
                }
            }
        @endphp
        @foreach(config('app.available_locales', ['en', 'lv']) as $locale)
            @if(isset($alternates[$locale]))
        <xhtml:link rel="alternate" hreflang="{{ $locale }}" href="{{ $alternates[$locale] }}"/>
            @endif
        @endforeach
    </url>
@endforeach
</urlset>