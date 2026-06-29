<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index-light');
})->name('home');

Route::view('/products', 'pages.products')->name('products');
Route::view('/custom-sportswear', 'pages.custom-sportswear')->name('custom-sportswear');
Route::view('/gallery', 'pages.gallery')->name('gallery');
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');

Route::redirect('/index-light.html', '/');
Route::redirect('/index.html', '/');
Route::redirect('/products.html', '/products');
Route::redirect('/custom-sportswear.html', '/custom-sportswear');
Route::redirect('/gallery.html', '/gallery');
Route::redirect('/about.html', '/about');
Route::redirect('/contact.html', '/contact');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.store');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::resource('product-categories', ProductCategoryController::class)->except('show');
        Route::resource('products', ProductController::class)->except('show');
    });
});
