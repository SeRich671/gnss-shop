<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'welcome'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    require __DIR__.'/admin.php';

    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('category/{category}', CategoryController::class)->name('category');

Route::get('product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::post('product/{product}/cart', [ProductController::class, 'addToCart'])->name('cart.add');
Route::post('product/clear', [ProductController::class, 'clearCart'])->name('cart.clear');
Route::put('product/{product}/cart', [ProductController::class, 'updateCart'])->name('cart.update');
Route::post('product/{product}/cart/remove', [ProductController::class, 'removeFromCart'])->name('cart.remove');

Route::get('order', [OrderController::class, 'index'])->name('order.index');
Route::post('order', [OrderController::class, 'store'])->name('order.store');

require __DIR__.'/auth.php';
