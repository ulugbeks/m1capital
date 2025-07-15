<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('translations')->latest()->paginate(20);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title.en' => 'required|string|max:255',
            'title.lv' => 'required|string|max:255',
            'content.en' => 'required',
            'content.lv' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $news = new News();
        
        // Генерируем slug из английского заголовка
        $news->slug = Str::slug($request->input('title.en'));
        
        // Проверяем уникальность slug
        $originalSlug = $news->slug;
        $count = 1;
        while (News::where('slug', $news->slug)->exists()) {
            $news->slug = $originalSlug . '-' . $count;
            $count++;
        }
        
        // Загружаем изображение
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('news', 'public');
            $news->image = $path;
        }
        
        $news->is_published = $request->boolean('is_published');
        $news->published_at = $request->boolean('is_published') ? now() : null;
        
        $news->save();
        
        // Сохраняем переводы
        $locales = config('app.available_locales', ['en', 'lv']);
        foreach ($locales as $locale) {
            $news->translateOrNew($locale)->title = $request->input("title.{$locale}");
            $news->translateOrNew($locale)->excerpt = $request->input("excerpt.{$locale}");
            $news->translateOrNew($locale)->content = $request->input("content.{$locale}");
            $news->translateOrNew($locale)->meta_title = $request->input("meta_title.{$locale}") ?: $request->input("title.{$locale}");
            $news->translateOrNew($locale)->meta_description = $request->input("meta_description.{$locale}") ?: Str::limit(strip_tags($request->input("content.{$locale}")), 160);
        }
        
        $news->save();
        
        return redirect()->route('admin.news.index')->with('success', 'News created successfully!');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title.en' => 'required|string|max:255',
            'title.lv' => 'required|string|max:255',
            'content.en' => 'required',
            'content.lv' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);
        
        // Обновляем slug если изменился английский заголовок
        if ($request->input('title.en') !== $news->translate('en')->title) {
            $news->slug = Str::slug($request->input('title.en'));
            
            // Проверяем уникальность slug
            $originalSlug = $news->slug;
            $count = 1;
            while (News::where('slug', $news->slug)->where('id', '!=', $news->id)->exists()) {
                $news->slug = $originalSlug . '-' . $count;
                $count++;
            }
        }
        
        // Обновляем изображение
        if ($request->hasFile('image')) {
            // Удаляем старое изображение
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            
            $path = $request->file('image')->store('news', 'public');
            $news->image = $path;
        }
        
        $news->is_published = $request->boolean('is_published');
        
        if ($request->boolean('is_published') && !$news->published_at) {
            $news->published_at = now();
        }
        
        $news->save();
        
        // Обновляем переводы
        $locales = config('app.available_locales', ['en', 'lv']);
        foreach ($locales as $locale) {
            $news->translateOrNew($locale)->title = $request->input("title.{$locale}");
            $news->translateOrNew($locale)->excerpt = $request->input("excerpt.{$locale}");
            $news->translateOrNew($locale)->content = $request->input("content.{$locale}");
            $news->translateOrNew($locale)->meta_title = $request->input("meta_title.{$locale}") ?: $request->input("title.{$locale}");
            $news->translateOrNew($locale)->meta_description = $request->input("meta_description.{$locale}") ?: Str::limit(strip_tags($request->input("content.{$locale}")), 160);
        }
        
        $news->save();
        
        return redirect()->route('admin.news.index')->with('success', 'News updated successfully!');
    }

    public function destroy(News $news)
    {
        // Удаляем изображение
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        
        $news->delete();
        
        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully!');
    }
}