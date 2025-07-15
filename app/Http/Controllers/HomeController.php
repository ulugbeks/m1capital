<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\News;
use App\Models\Product;
use App\Models\Partner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'home')->firstOrFail();
        $latestNews = News::published()->latest('published_at')->take(3)->get();
        
        // Загружаем продукты для главной страницы
        $products = Product::active()
                          ->whereHas('pages', function($query) use ($page) {
                              $query->where('page_id', $page->id);
                          })
                          ->ordered()
                          ->get();
        
        // Загружаем партнеров
        $partners = Partner::active()->ordered()->get();
        
        return view('home', compact('page', 'latestNews', 'products', 'partners'));
    }
}