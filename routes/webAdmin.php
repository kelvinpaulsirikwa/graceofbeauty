<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControllers\AuthController;
use App\Http\Controllers\AdminControllers\DashboardController;
use App\Http\Controllers\AdminControllers\CategoryController;
use App\Http\Controllers\AdminControllers\SubcategoryController;
use App\Http\Controllers\AdminControllers\BrandController;
use App\Http\Controllers\AdminControllers\ProductAttributeController;
use App\Http\Controllers\AdminControllers\ProductController;
use App\Http\Controllers\AdminControllers\ProductImageController;
use App\Http\Controllers\AdminControllers\ServiceImageController;
use App\Http\Controllers\AdminControllers\LeadershipTeamController;
use App\Http\Controllers\AdminControllers\ServiceController;
use App\Http\Controllers\AdminControllers\PaymentController;
use App\Http\Controllers\AdminControllers\UserFeedbackController;
use App\Http\Controllers\AdminControllers\UserController;
use App\Http\Controllers\AdminControllers\ProfileController;
use App\Http\Controllers\AdminControllers\ConsultationController;

// Admin Authentication Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    
    // Protected routes (accessible by both admin and user)
    Route::middleware(['auth', 'check.blocked'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        
        // Products - accessible by both admin and user
        Route::resource('products', ProductController::class)->names([
            'index' => 'admin.products.index',
            'create' => 'admin.products.create',
            'store' => 'admin.products.store',
            'show' => 'admin.products.show',
            'edit' => 'admin.products.edit',
            'update' => 'admin.products.update',
            'destroy' => 'admin.products.destroy',
        ]);

        // User Feedback - accessible by both admin and user
        Route::resource('user-feedbacks', UserFeedbackController::class)->names([
            'index' => 'admin.user_feedbacks.index',
            'create' => 'admin.user_feedbacks.create',
            'store' => 'admin.user_feedbacks.store',
            'show' => 'admin.user_feedbacks.show',
            'edit' => 'admin.user_feedbacks.edit',
            'update' => 'admin.user_feedbacks.update',
            'destroy' => 'admin.user_feedbacks.destroy',
        ]);

        // Profile Management Routes - accessible by both admin and user
        Route::get('profile', [ProfileController::class, 'index'])->name('admin.profile.index');
        Route::put('profile', [ProfileController::class, 'updateProfile'])->name('admin.profile.update');
        Route::put('profile/change-password', [ProfileController::class, 'changePassword'])->name('admin.profile.change-password');
    });

    // Admin-only routes
    Route::middleware(['auth', 'check.blocked', 'check.admin'])->group(function () {
        // Category CRUD Routes
        Route::resource('categories', CategoryController::class)->names([
            'index' => 'admin.categories.index',
            'create' => 'admin.categories.create',
            'store' => 'admin.categories.store',
            'show' => 'admin.categories.show',
            'edit' => 'admin.categories.edit',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy',
        ]);

        // Subcategory CRUD Routes
        Route::resource('subcategories', SubcategoryController::class)->names([
            'index' => 'admin.subcategories.index',
            'create' => 'admin.subcategories.create',
            'store' => 'admin.subcategories.store',
            'show' => 'admin.subcategories.show',
            'edit' => 'admin.subcategories.edit',
            'update' => 'admin.subcategories.update',
            'destroy' => 'admin.subcategories.destroy',
        ]);

        // Brand CRUD Routes
        Route::resource('brands', BrandController::class)->names([
            'index' => 'admin.brands.index',
            'create' => 'admin.brands.create',
            'store' => 'admin.brands.store',
            'show' => 'admin.brands.show',
            'edit' => 'admin.brands.edit',
            'update' => 'admin.brands.update',
            'destroy' => 'admin.brands.destroy',
        ]);

        // Product Attribute CRUD Routes
        Route::resource('product-attributes', ProductAttributeController::class)->names([
            'index' => 'admin.product_attributes.index',
            'create' => 'admin.product_attributes.create',
            'store' => 'admin.product_attributes.store',
            'show' => 'admin.product_attributes.show',
            'edit' => 'admin.product_attributes.edit',
            'update' => 'admin.product_attributes.update',
            'destroy' => 'admin.product_attributes.destroy',
        ]);

        // Product Images CRUD Routes (nested under products)
        Route::resource('products.product_images', ProductImageController::class)->names([
            'index' => 'admin.product_images.index',
            'create' => 'admin.product_images.create',
            'store' => 'admin.product_images.store',
            'show' => 'admin.product_images.show',
            'edit' => 'admin.product_images.edit',
            'update' => 'admin.product_images.update',
            'destroy' => 'admin.product_images.destroy',
        ]);

        // Leadership Team CRUD Routes
        Route::resource('leadership-teams', LeadershipTeamController::class)->names([
            'index' => 'admin.leadership_teams.index',
            'create' => 'admin.leadership_teams.create',
            'store' => 'admin.leadership_teams.store',
            'show' => 'admin.leadership_teams.show',
            'edit' => 'admin.leadership_teams.edit',
            'update' => 'admin.leadership_teams.update',
            'destroy' => 'admin.leadership_teams.destroy',
        ]);

        // Service CRUD Routes
        Route::resource('services', ServiceController::class)->names([
            'index' => 'admin.services.index',
            'create' => 'admin.services.create',
            'store' => 'admin.services.store',
            'show' => 'admin.services.show',
            'edit' => 'admin.services.edit',
            'update' => 'admin.services.update',
            'destroy' => 'admin.services.destroy',
        ]);

        // Service Images CRUD Routes (nested under services)
        Route::resource('services.service_images', ServiceImageController::class)->names([
            'index' => 'admin.services.service_images.index',
            'create' => 'admin.services.service_images.create',
            'store' => 'admin.services.service_images.store',
            'show' => 'admin.services.service_images.show',
            'edit' => 'admin.services.service_images.edit',
            'update' => 'admin.services.service_images.update',
            'destroy' => 'admin.services.service_images.destroy',
        ]);

        // Payment CRUD Routes
        Route::resource('payments', PaymentController::class)->names([
            'index' => 'admin.payments.index',
            'create' => 'admin.payments.create',
            'store' => 'admin.payments.store',
            'show' => 'admin.payments.show',
            'edit' => 'admin.payments.edit',
            'update' => 'admin.payments.update',
            'destroy' => 'admin.payments.destroy',
        ]);

        // Consultation Routes
        Route::resource('consultations', ConsultationController::class)->names([
            'index' => 'admin.consultations.index',
            'show' => 'admin.consultations.show',
            'destroy' => 'admin.consultations.destroy',
        ])->only(['index', 'show', 'destroy']);
        
        Route::put('consultations/{id}/toggle-read', [ConsultationController::class, 'toggleRead'])->name('admin.consultations.toggle-read');

        // User CRUD Routes
        Route::resource('users', UserController::class)->names([
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'show' => 'admin.users.show',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ]);

        // User block/unblock route
        Route::put('users/{id}/toggle-block', [UserController::class, 'toggleBlock'])->name('admin.users.toggle-block');

        // User reset password route
        Route::put('users/{id}/reset-password', [UserController::class, 'resetPassword'])->name('admin.users.reset-password');
    });
});

