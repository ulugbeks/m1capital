<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($locale, $slug)
    {
        $page = Page::where('slug', $slug)->active()->firstOrFail();
        
        // Определяем какой шаблон использовать
        $template = match($page->slug) {
            'about' => 'pages.about',
            'contact' => 'pages.contact',
            'how-we-work' => 'pages.how-we-work',
            default => 'pages.default'
        };
        
        // Для страницы About загружаем дополнительные данные
        if ($page->slug === 'about') {
            $teamMembers = \App\Models\TeamMember::active()->ordered()->get();
            $partners = \App\Models\Partner::active()->ordered()->get();
            
            return view($template, compact('page', 'teamMembers', 'partners'));
        }
        
        return view($template, compact('page'));
    }

    public function solutions()
    {
        $page = Page::where('slug', 'solutions')->firstOrFail();
        $solutions = Page::where('type', 'solution')->active()->ordered()->get();
        
        return view('pages.solutions', compact('page', 'solutions'));
    }

    public function solution($slug)
    {
        $solution = Page::where('slug', $slug)
                       ->where('type', 'solution')
                       ->active()
                       ->firstOrFail();
        
        return view('pages.solution', compact('solution'));
    }
}