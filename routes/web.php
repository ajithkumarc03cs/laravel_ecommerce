<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

use App\Http\Controllers\Seller\ProductController as SellerProductController;

use App\Http\Controllers\Customer\ProductController as CustomerProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
// =====================================================
// PUBLIC ROUTES
// =====================================================

Route::get(
    '/',
    [HomeController::class, 'index']
)->name('home');

// Customer can view products WITHOUT login
Route::get(
    '/products',
    [CustomerProductController::class, 'index']
)->name('products.index');

Route::get(
    '/products/{product}',
    [CustomerProductController::class, 'show']
)->name('products.show');

/*
|--------------------------------------------------------------------------
| Cart
|--------------------------------------------------------------------------
*/

Route::post(
    '/cart/add/{product}',
    [CartController::class, 'add']
)->name('cart.add');

Route::get(
    '/cart',
    [CartController::class, 'index']
)->name('cart.index');

Route::put(
    '/cart/update/{productId}',
    [CartController::class, 'update']
)->name('cart.update');

Route::delete(
    '/cart/remove/{productId}',
    [CartController::class, 'remove']
)->name('cart.remove');

Route::delete(
    '/cart/clear',
    [CartController::class, 'clear']
)->name('cart.clear');
// =====================================================
// AUTHENTICATED COMMON ROUTES
// =====================================================

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


// =====================================================
// ADMIN ROUTES
// =====================================================

Route::middleware(['auth', 'role:admin'])->group(function () {

    // Admin dashboard
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');


    // Users
    Route::get('/admin/users', [UserController::class, 'index'])
        ->name('admin.users.index');

    Route::put('/admin/users/{user}/role', [UserController::class, 'updateRole'])
        ->name('admin.users.updateRole');

    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])
        ->name('admin.users.destroy');


    // Categories
    Route::resource(
        'admin/categories',
        CategoryController::class
    )->names('admin.categories');


    // Products
    Route::resource(
        'admin/products',
        ProductController::class
    )->names('admin.products');
});


// =====================================================
// SELLER ROUTES
// =====================================================

Route::middleware(['auth', 'role:seller'])->group(function () {

    // Seller dashboard
    Route::get('/seller/dashboard', function () {
        return view('seller.dashboard');
    })->name('seller.dashboard');


    // Seller product management
    Route::resource(
        'seller/products',
        SellerProductController::class
    )->names('seller.products');
});


// =====================================================
// CUSTOMER PROTECTED ROUTES
// =====================================================

Route::middleware(['auth', 'role:customer'])->group(function () {

    Route::get('/customer/dashboard', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');

    Route::get('/orders', [OrderController::class, 'index'])
    ->name('orders.index');

    Route::get('/orders/{order}', [OrderController::class, 'show'])
            ->name('orders.show');
    });

    // Later:
    // Cart
    // Orders
    // Wishlist
    // Checkout

// });
Route::middleware(['auth'])->group(function () {

    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])
        ->name('checkout.placeOrder');

});

require __DIR__.'/auth.php';