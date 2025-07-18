<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\PartnerController as AdminPartnerController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AuthController;

// Редирект с корня на язык по умолчанию
Route::get('/', function () {
    return redirect('/en');
});

// Группа маршрутов с префиксом языка
Route::prefix('{locale}')
    ->where(['locale' => 'en|lv'])
    ->middleware('setlocale')
    ->group(function () {
        // Главная страница
        Route::get('/', [HomeController::class, 'index'])->name('home');
        
        // Страница решений
        Route::get('/solutions', [PageController::class, 'solutions'])->name('solutions');
        Route::get('/solutions/{slug}', [PageController::class, 'solution'])->name('solution');
        
        // Новости
        Route::get('/news', [NewsController::class, 'index'])->name('news.index');
        Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');
        
        // Контактная форма
        Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
        
        // Статические страницы - должны быть в конце
        Route::get('/{slug}', [PageController::class, 'show'])
            ->where('slug', 'about|contact|how-we-work')
            ->name('page');
    });

// Для обратной совместимости имен маршрутов
Route::name('about')->get('/{locale}/about', function() {});
Route::name('contact')->get('/{locale}/contact', function() {});
Route::name('how-we-work')->get('/{locale}/how-we-work', function() {});

// Админ панель - авторизация
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

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
        Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products.index');
        Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
        Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');
        Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
        
        // Управление партнерами
        Route::get('/partners', [AdminPartnerController::class, 'index'])->name('admin.partners.index');
        Route::get('/partners/create', [AdminPartnerController::class, 'create'])->name('admin.partners.create');
        Route::post('/partners', [AdminPartnerController::class, 'store'])->name('admin.partners.store');
        Route::get('/partners/{partner}/edit', [AdminPartnerController::class, 'edit'])->name('admin.partners.edit');
        Route::put('/partners/{partner}', [AdminPartnerController::class, 'update'])->name('admin.partners.update');
        Route::delete('/partners/{partner}', [AdminPartnerController::class, 'destroy'])->name('admin.partners.destroy');
        
        // Настройки
        Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings');
        Route::post('/settings', [SettingController::class, 'update'])->name('admin.settings.update');
    });