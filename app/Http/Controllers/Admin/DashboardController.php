<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\News;

class DashboardController extends Controller
{
    public function index()
    {
        $pagesCount = Page::count();
        $newsCount = News::count();
        $latestNews = News::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('pagesCount', 'newsCount', 'latestNews'));
    }
}