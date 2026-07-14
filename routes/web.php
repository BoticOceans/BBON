<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CollarController;
use App\Http\Controllers\Admin\ColourController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FabricController;
use App\Http\Controllers\Admin\GalleryItemController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderTypeController;
use App\Http\Controllers\Admin\PatchController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ContactSubmissionController as AdminContactSubmissionController;
use App\Http\Controllers\ContactSubmissionController;
use App\Http\Controllers\PublicCatalogController;
use App\Http\Controllers\PublicHomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', PublicHomeController::class)->name('home');

Route::get('/products', [PublicCatalogController::class, 'products'])->name('products');
Route::get('/custom-sportswear', [PublicCatalogController::class, 'customSportswear'])->name('custom-sportswear');
Route::get('/gallery', [PublicCatalogController::class, 'gallery'])->name('gallery');
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
Route::post('/contact', [ContactSubmissionController::class, 'store'])->name('contact.store');

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
        Route::get('homepage', [HomepageController::class, 'edit'])->name('homepage.edit');
        Route::put('homepage', [HomepageController::class, 'update'])->name('homepage.update');
        Route::resource('product-categories', ProductCategoryController::class)->except('show');
        Route::resource('products', ProductController::class)->except('show');
        Route::resource('gallery-items', GalleryItemController::class)->except('show');
        Route::resource('orders', OrderController::class)->except('show');

        Route::get('contact-submissions', [AdminContactSubmissionController::class, 'index'])->name('contact-submissions.index');
        Route::patch('contact-submissions/{contactSubmission}/mark-read', [AdminContactSubmissionController::class, 'markRead'])->name('contact-submissions.mark-read');
        Route::delete('contact-submissions/{contactSubmission}', [AdminContactSubmissionController::class, 'destroy'])->name('contact-submissions.destroy');

        Route::resource('order-types', OrderTypeController::class)->except('show')->parameters(['order-types' => 'item']);
        Route::resource('collars', CollarController::class)->except('show')->parameters(['collars' => 'item']);
        Route::resource('fabrics', FabricController::class)->except('show')->parameters(['fabrics' => 'item']);
        Route::resource('colours', ColourController::class)->except('show')->parameters(['colours' => 'item']);
        Route::resource('patches', PatchController::class)->except('show')->parameters(['patches' => 'item']);
        Route::resource('sizes', SizeController::class)->except('show')->parameters(['sizes' => 'item']);
    });
});
