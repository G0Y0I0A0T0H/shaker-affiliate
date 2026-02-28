<?php

use App\Http\Controllers\Admin\AffiliateController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Affiliate\DashboardController;
use App\Http\Controllers\Affiliate\OrderController as AffiliateOrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductGalleryController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'role:affiliate,admin'])->group(function (): void {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('affiliate')->name('affiliate.')->middleware('role:affiliate')->group(function (): void {
        Route::resource('orders', AffiliateOrderController::class)->only(['index', 'create', 'store']);
    });

    Route::get('/products/{product}', [ProductGalleryController::class, 'show'])->name('products.show');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function (): void {
    Route::get('/affiliates', [AffiliateController::class, 'index'])->name('affiliates.index');
    Route::post('/affiliates', [AffiliateController::class, 'store'])->name('affiliates.store');
    Route::patch('/affiliates/{affiliate}/suspend', [AffiliateController::class, 'suspend'])->name('affiliates.suspend');
    Route::delete('/affiliates/{affiliate}', [AffiliateController::class, 'destroy'])->name('affiliates.destroy');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::post('/products/{product}/variants', [ProductController::class, 'storeVariant'])->name('variants.store');
    Route::post('/variants/{variant}/sizes', [ProductController::class, 'storeSize'])->name('sizes.store');
    Route::post('/variants/images', [ProductController::class, 'storeImage'])->name('images.store');

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
});
