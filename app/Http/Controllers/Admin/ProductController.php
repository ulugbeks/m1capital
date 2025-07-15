<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('translations')->ordered()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $pages = Page::whereIn('type', ['static', 'solution'])->get();
        return view('admin.products.create', compact('pages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string|unique:products,key',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order' => 'nullable|integer',
            'title.en' => 'required|string|max:255',
            'title.lv' => 'required|string|max:255',
        ]);

        $product = new Product();
        $product->key = $request->input('key');
        $product->order = $request->input('order', 0);
        $product->is_active = $request->boolean('is_active');

        // Загружаем изображение
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->save();

        // Сохраняем переводы
        $locales = config('app.available_locales', ['en', 'lv']);
        foreach ($locales as $locale) {
            $product->translateOrNew($locale)->title = $request->input("title.{$locale}");
            $product->translateOrNew($locale)->subtitle = $request->input("subtitle.{$locale}");
            $product->translateOrNew($locale)->description = $request->input("description.{$locale}");
            $product->translateOrNew($locale)->manufacturers_standard = $request->input("manufacturers_standard.{$locale}");
            $product->translateOrNew($locale)->features = $request->input("features.{$locale}", []);
            $product->translateOrNew($locale)->applications = $request->input("applications.{$locale}", []);
        }

        $product->save();

        // Привязываем к страницам
        if ($request->has('pages')) {
            $product->pages()->sync($request->input('pages'));
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $pages = Page::whereIn('type', ['static', 'solution'])->get();
        $selectedPages = $product->pages->pluck('id')->toArray();
        return view('admin.products.edit', compact('product', 'pages', 'selectedPages'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'key' => 'required|string|unique:products,key,' . $product->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order' => 'nullable|integer',
            'title.en' => 'required|string|max:255',
            'title.lv' => 'required|string|max:255',
        ]);

        $product->key = $request->input('key');
        $product->order = $request->input('order', 0);
        $product->is_active = $request->boolean('is_active');

        // Обновляем изображение
        if ($request->hasFile('image')) {
            // Удаляем старое изображение
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->save();

        // Обновляем переводы
        $locales = config('app.available_locales', ['en', 'lv']);
        foreach ($locales as $locale) {
            $product->translateOrNew($locale)->title = $request->input("title.{$locale}");
            $product->translateOrNew($locale)->subtitle = $request->input("subtitle.{$locale}");
            $product->translateOrNew($locale)->description = $request->input("description.{$locale}");
            $product->translateOrNew($locale)->manufacturers_standard = $request->input("manufacturers_standard.{$locale}");
            $product->translateOrNew($locale)->features = $request->input("features.{$locale}", []);
            $product->translateOrNew($locale)->applications = $request->input("applications.{$locale}", []);
        }

        $product->save();

        // Обновляем привязки к страницам
        if ($request->has('pages')) {
            $product->pages()->sync($request->input('pages'));
        } else {
            $product->pages()->detach();
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        // Удаляем изображение
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}