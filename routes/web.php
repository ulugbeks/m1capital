<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\SettingController;

// Редирект с корня на язык по умолчанию
Route::get('/', function () {
    return redirect(app()->getLocale());
});

// Группа маршрутов с префиксом языка
Route::prefix('{locale}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware('setlocale')
    ->group(function () {
        // Главная страница
        Route::get('/', [HomeController::class, 'index'])->name('home');
        
        // Страница решений
        Route::get('/solutions', [PageController::class, 'solutions'])->name('solutions');
        Route::get('/solutions/{slug}', [PageController::class, 'solution'])->name('solution');
        
        // Новости
        Route::get('/news', [NewsController::class, 'index'])->name('news.index');
        Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
        
        // Статические страницы
        Route::get('/about', [PageController::class, 'show'])->name('about');
        Route::get('/contact', [PageController::class, 'show'])->name('contact');
        Route::post('/contact', [App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');
        Route::get('/how-we-work', [PageController::class, 'show'])->name('how-we-work');
    });

// Админ панель - авторизация
Route::get('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
Route::post('/admin/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

// Админ панель - защищенные маршруты
Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        
        // Управление страницами
        Route::get('/pages', [AdminPageController::class, 'index'])->name('admin.pages.index');
        Route::get('/pages/{page}/edit', [AdminPageController::class, 'edit'])->name('admin.pages.edit');
        Route::put('/pages/{page}', [AdminPageController::class, 'update'])->name('admin.pages.update');
        
        // Управление новостями
        Route::get('/news', [AdminNewsController::class, 'index'])->name('admin.news.index');
        Route::get('/news/create', [AdminNewsController::class, 'create'])->name('admin.news.create');
        Route::post('/news', [AdminNewsController::class, 'store'])->name('admin.news.store');
        Route::get('/news/{news}/edit', [AdminNewsController::class, 'edit'])->name('admin.news.edit');
        Route::put('/news/{news}', [AdminNewsController::class, 'update'])->name('admin.news.update');
        Route::delete('/news/{news}', [AdminNewsController::class, 'destroy'])->name('admin.news.destroy');
        
        // Управление продуктами
        Route::get('/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/products/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/products', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/products/{product}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.products.destroy');
        
        // Управление партнерами
        Route::get('/partners', [App\Http\Controllers\Admin\PartnerController::class, 'index'])->name('admin.partners.index');
        Route::get('/partners/create', [App\Http\Controllers\Admin\PartnerController::class, 'create'])->name('admin.partners.create');
        Route::post('/partners', [App\Http\Controllers\Admin\PartnerController::class, 'store'])->name('admin.partners.store');
        Route::get('/partners/{partner}/edit', [App\Http\Controllers\Admin\PartnerController::class, 'edit'])->name('admin.partners.edit');
        Route::put('/partners/{partner}', [App\Http\Controllers\Admin\PartnerController::class, 'update'])->name('admin.partners.update');
        Route::delete('/partners/{partner}', [App\Http\Controllers\Admin\PartnerController::class, 'destroy'])->name('admin.partners.destroy');
        
        // Настройки
        Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings');
        Route::post('/settings', [SettingController::class, 'update'])->name('admin.settings.update');
    });