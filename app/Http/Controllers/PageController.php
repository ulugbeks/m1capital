<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Partner;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($locale, $slug = null)
    {
        // Если slug не передан, но locale на самом деле является slug
        if ($slug === null && in_array($locale, ['about', 'contact', 'how-we-work', 'terms', 'privacy', 'cookies'])) {
            $slug = $locale;
            $locale = app()->getLocale();
        }
        
        $page = Page::where('slug', $slug)->active()->firstOrFail();
        
        // Определяем какой шаблон использовать
        $template = match($page->slug) {
            'about' => 'pages.about',
            'contact' => 'pages.contact',
            'how-we-work' => 'pages.how-we-work',
            'terms', 'privacy', 'cookies' => 'pages.legal',
            default => 'pages.default'
        };
        
        // Для страницы About загружаем дополнительные данные
        if ($page->slug === 'about') {
            $partners = Partner::active()->ordered()->get();
            
            // Группируем партнеров по категориям для страницы About
            $partnersData = [];
            foreach ($partners->groupBy('category') as $category => $categoryPartners) {
                $partnersData[$category] = $categoryPartners->map(function($partner) {
                    return [
                        'name' => $partner->name,
                        'logo' => asset('storage/' . $partner->logo)
                    ];
                })->toArray();
            }
            
            return view($template, compact('page', 'partners', 'partnersData'));
        }
        
        return view($template, compact('page'));
    }

    public function solutions($locale)
    {
        $page = Page::where('slug', 'solutions')->firstOrFail();
        
        // Загружаем страницы решений
        $solutions = Page::where('type', 'solution')
                        ->active()
                        ->ordered()
                        ->get();
        
        return view('pages.solutions', compact('page', 'solutions'));
    }

    public function solution($locale, $slug)
    {
        $solution = Page::where('slug', $slug)
                       ->where('type', 'solution')
                       ->active()
                       ->firstOrFail();
        
        return view('pages.solution', compact('solution'));
    }
}