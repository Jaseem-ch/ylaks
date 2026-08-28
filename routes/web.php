<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Store\HomeController;
use App\Http\Controllers\Store\CatalogController;
use App\Http\Controllers\Store\RequestBasketController;
use App\Http\Controllers\Store\ItemRequestController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminItemRequestController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes - Vogue & Velvet Storefront & Administration
|--------------------------------------------------------------------------
*/

// Public Storefront Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{slug}', [CatalogController::class, 'show'])->name('catalog.show');

// Request Basket Routes
Route::get('/basket', [RequestBasketController::class, 'index'])->name('basket.index');
Route::post('/basket/add', [RequestBasketController::class, 'add'])->name('basket.add');
Route::patch('/basket/update/{id}', [RequestBasketController::class, 'update'])->name('basket.update');
Route::delete('/basket/remove/{id}', [RequestBasketController::class, 'remove'])->name('basket.remove');
Route::post('/basket/clear', [RequestBasketController::class, 'clear'])->name('basket.clear');

// Item Request Submission Routes (with route aliases for form/submit)
Route::get('/request-items', [ItemRequestController::class, 'create'])->name('request.create');
Route::get('/request-form', [ItemRequestController::class, 'create'])->name('request.form');

Route::post('/request-items', [ItemRequestController::class, 'store'])->name('request.store');
Route::post('/request-submit', [ItemRequestController::class, 'store'])->name('request.submit');

Route::get('/request-confirmation/{referenceCode}', [ItemRequestController::class, 'success'])->name('request.success');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Panel Routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Item Request Management
    Route::get('/requests', [AdminItemRequestController::class, 'index'])->name('admin.requests.index');
    Route::get('/requests/{id}', [AdminItemRequestController::class, 'show'])->name('admin.requests.show');
    Route::post('/requests/{id}/status', [AdminItemRequestController::class, 'updateStatus'])->name('admin.requests.update-status');

    // Product Management
    Route::resource('products', AdminProductController::class, ['names' => 'admin.products']);

    // Category Management
    Route::resource('categories', AdminCategoryController::class, ['names' => 'admin.categories'])->except(['create', 'show', 'edit']);
});
