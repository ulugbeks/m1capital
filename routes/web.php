<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\PartnerController as AdminPartnerController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root to default locale
Route::get('/', function () {
    return redirect()->route('home', ['locale' => config('app.locale', 'en')]);
});

// Admin routes (without locale)
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.post');
    
    Route::middleware(['auth'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
        
        // Pages management
        Route::get('/pages', [AdminPageController::class, 'index'])->name('admin.pages.index');
        Route::get('/pages/{page}/edit', [AdminPageController::class, 'edit'])->name('admin.pages.edit');
        Route::put('/pages/{page}', [AdminPageController::class, 'update'])->name('admin.pages.update');
        
        // News management
        Route::resource('news', AdminNewsController::class)->names([
            'index' => 'admin.news.index',
            'create' => 'admin.news.create',
            'store' => 'admin.news.store',
            'edit' => 'admin.news.edit',
            'update' => 'admin.news.update',
            'destroy' => 'admin.news.destroy'
        ]);
        
        // Products management
        Route::resource('products', AdminProductController::class)->names([
            'index' => 'admin.products.index',
            'create' => 'admin.products.create',
            'store' => 'admin.products.store',
            'edit' => 'admin.products.edit',
            'update' => 'admin.products.update',
            'destroy' => 'admin.products.destroy'
        ]);
        
        // Partners management
        Route::resource('partners', AdminPartnerController::class)->names([
            'index' => 'admin.partners.index',
            'create' => 'admin.partners.create',
            'store' => 'admin.partners.store',
            'edit' => 'admin.partners.edit',
            'update' => 'admin.partners.update',
            'destroy' => 'admin.partners.destroy'
        ]);
        
        // Settings
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('admin.settings');
        Route::post('/settings', [AdminSettingController::class, 'update'])->name('admin.settings.update');
    });
});

// Localized routes
Route::prefix('{locale}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware('setlocale')
    ->group(function () {
        // Home
        Route::get('/', [HomeController::class, 'index'])->name('home');
        
        // News
        Route::get('/news', [NewsController::class, 'index'])->name('news.index');
        Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
        
        // Solutions
        Route::get('/solutions', [PageController::class, 'solutions'])->name('solutions');
        Route::get('/solutions/{slug}', [PageController::class, 'solution'])->name('solution');
        
        // Contact form submission
        Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');
        
        // Static pages (including legal pages)
        Route::get('/{slug}', [PageController::class, 'show'])->name('page')
            ->where('slug', 'about|contact|how-we-work|terms|privacy|cookies');
    });

// Authentication routes (if needed for regular users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';