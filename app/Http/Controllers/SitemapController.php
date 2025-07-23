<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\News;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $locales = config('app.available_locales', ['en', 'lv']);
        
        // Собираем все URL
        $urls = [];
        
        // Главная страница для каждого языка
        foreach ($locales as $locale) {
            $urls[] = [
                'loc' => route('home', ['locale' => $locale]),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '1.0'
            ];
        }
        
        // Страницы
        $pages = Page::active()->get();
        
        foreach ($pages as $page) {
            foreach ($locales as $locale) {
                $priority = '0.8';
                $changefreq = 'monthly';
                
                // Определяем приоритет и частоту обновления
                if (in_array($page->slug, ['about', 'contact'])) {
                    $priority = '0.9';
                    $changefreq = 'monthly';
                } elseif ($page->type === 'solution') {
                    $priority = '0.9';
                    $changefreq = 'weekly';
                } elseif ($page->type === 'legal') {
                    $priority = '0.5';
                    $changefreq = 'yearly';
                }
                
                // Определяем правильный маршрут
                if ($page->slug === 'solutions') {
                    $url = route('solutions', ['locale' => $locale]);
                } elseif ($page->type === 'solution') {
                    $url = route('solution', ['locale' => $locale, 'slug' => $page->slug]);
                } else {
                    $url = route('page', ['locale' => $locale, 'slug' => $page->slug]);
                }
                
                $urls[] = [
                    'loc' => $url,
                    'lastmod' => $page->updated_at->toAtomString(),
                    'changefreq' => $changefreq,
                    'priority' => $priority
                ];
            }
        }
        
        // Страница новостей
        foreach ($locales as $locale) {
            $urls[] = [
                'loc' => route('news.index', ['locale' => $locale]),
                'lastmod' => News::published()->latest()->first()?->updated_at->toAtomString() ?? now()->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '0.8'
            ];
        }
        
        // Отдельные новости
        $news = News::published()->get();
        
        foreach ($news as $article) {
            foreach ($locales as $locale) {
                $urls[] = [
                    'loc' => route('news.show', ['locale' => $locale, 'news' => $article]),
                    'lastmod' => $article->updated_at->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.7'
                ];
            }
        }
        
        $content = view('sitemap', compact('urls'))->render();
        
        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }
}