<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'searchProduct'])->name('search.product');
Route::get('/category/{category_id}', [HomeController::class, 'productCategory'])->name('product.category');

// Fitur keranjang dengan session
Route::get('cart', [CartController::class, 'showCart'])->name('cart.index');
Route::get('add-to-cart/{product_id}', [CartController::class, 'addToCart'])->name('cart.add-to-cart');
Route::get('delete-cart/{product_id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('cart', [CartController::class, 'updateCart'])->name('cart.update');

Route::middleware('auth')->group(function () {
    Route::post('cart-order', [ProductController::class, 'order'])->name('cart.order');
    // Fitur keranjang dengan database
    Route::controller(CartController::class)->group(function () {
        Route::get('/carts', 'index')->name('carts.index');
        Route::get('/add-to-carts/{product_id}', 'addToCartWithUser')->name('carts.add-to-cart');
        Route::post('/carts/update/{product_id}', 'update')->name('carts.update');
        Route::get('/carts/delete/{product_id}', 'destroy')->name('carts.destroy');
    });

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboards');
        Route::resource('/category', CategoryController::class);
        // category.store
        // category.update
        Route::resource('/product', ProductController::class);
    });
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('product/{id}', [ProductController::class, 'show'])->name('product.show');

require __DIR__.'/auth.php';
