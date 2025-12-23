<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteControllers\HomeController;
use App\Http\Controllers\WebsiteControllers\ContactUsController;
use App\Http\Controllers\WebsiteControllers\MadeForYouController;
use App\Http\Controllers\WebsiteControllers\ProductController as WebsiteProductController;
use App\Http\Controllers\WebsiteControllers\CategoryController as WebsiteCategoryController;
use App\Http\Controllers\WebsiteControllers\ServiceController as WebsiteServiceController;
use App\Http\Controllers\WebsiteControllers\GalleryController as WebsiteGalleryController;
use App\Http\Controllers\WebsiteControllers\BrandController as WebsiteBrandController;
use App\Http\Controllers\WebsiteControllers\UserFeedbackController as WebsiteUserFeedbackController;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/api/subcategories/{categoryId}', [HomeController::class, 'getSubcategories'])->name('api.subcategories');
Route::post('/api/products/filter', [HomeController::class, 'filterProducts'])->name('api.products.filter');
Route::get('/product/{id}', [WebsiteProductController::class, 'show'])->name('product.show');
Route::get('/category/{id}', [WebsiteCategoryController::class, 'show'])->name('category.show');
Route::post('/api/category/{categoryId}/products/filter', [WebsiteCategoryController::class, 'filterProducts'])->name('api.category.products.filter');
Route::get('/services', [WebsiteServiceController::class, 'index'])->name('services');
Route::get('/services/{id}', [WebsiteServiceController::class, 'show'])->name('services.show');
Route::get('/gallery', [WebsiteGalleryController::class, 'index'])->name('gallery');
Route::get('/user-feedback/{id}/story', [WebsiteUserFeedbackController::class, 'showStory'])->name('user.feedback.story');
Route::get('/brand/{id}/products', [WebsiteBrandController::class, 'showProducts'])->name('brand.products');
Route::get('/made-for-you', [MadeForYouController::class, 'index'])->name('made-for-you');
Route::get('/contact', [ContactUsController::class, 'index'])->name('contact');
Route::post('/contact', [ContactUsController::class, 'store'])->name('contact.submit');

