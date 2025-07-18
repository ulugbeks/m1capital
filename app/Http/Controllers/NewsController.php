<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Page;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'news')->firstOrFail();
        
        $news = News::published()
                    ->latest('published_at')
                    ->paginate(12);
        
        return view('news.index', compact('news', 'page'));
    }

    public function show($locale, News $news)
    {
        if (!$news->is_published || $news->published_at > now()) {
            abort(404);
        }
        
        $relatedNews = News::published()
                          ->where('id', '!=', $news->id)
                          ->latest('published_at')
                          ->take(3)
                          ->get();
        
        return view('news.show', compact('news', 'relatedNews'));
    }
}