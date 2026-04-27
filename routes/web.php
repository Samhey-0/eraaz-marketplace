<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorRequestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

/*
|--------------------------------------------------------------------------
| Authenticated Routes (any role)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Dynamic Dashboard Redirect
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->role === 'admin') return redirect()->route('admin.dashboard');
        if ($user->role === 'vendor') return redirect()->route('vendor.dashboard');
        return redirect()->route('customer.dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Customer-only Cart & Orders
    Route::middleware(['role:customer'])->group(function () {
        // Cart
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
        Route::patch('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
        Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

        // Orders
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
        Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    });

    // Vendor Application (for customers)
    Route::get('/vendor-request', [App\Http\Controllers\VendorRequestController::class, 'create'])->name('vendor.request.create');
    Route::post('/vendor-request', [App\Http\Controllers\VendorRequestController::class, 'store'])->name('vendor.request.store');

    // Notifications
    Route::get('/notifications/latest', [App\Http\Controllers\NotificationController::class, 'latest'])->name('notifications.latest');
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
});

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:customer'])->prefix('customer')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
});

/*
|--------------------------------------------------------------------------
| Vendor Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Vendor\DashboardController::class, 'index'])->name('dashboard');

    // Vendor Products
    Route::resource('products', App\Http\Controllers\Vendor\ProductController::class);

    // Vendor Orders
    Route::get('/orders', [App\Http\Controllers\Vendor\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{orderItem}', [App\Http\Controllers\Vendor\OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{orderItem}/status', [App\Http\Controllers\Vendor\OrderController::class, 'updateStatus'])->name('orders.update-status');
    // Earnings
    Route::get('/earnings', [App\Http\Controllers\Vendor\EarningController::class, 'index'])->name('earnings.index');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);

    // Products
    Route::get('/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products.index');
    Route::patch('/products/{product}/toggle', [App\Http\Controllers\Admin\ProductController::class, 'toggleStatus'])->name('products.toggle');
    Route::delete('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('products.destroy');

    // Orders
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');

    // Users
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');

    // Vendor Requests
    Route::get('/vendor-requests', [App\Http\Controllers\Admin\VendorRequestController::class, 'index'])->name('vendor-requests.index');
    Route::get('/vendor-requests/{vendorRequest}', [App\Http\Controllers\Admin\VendorRequestController::class, 'show'])->name('vendor-requests.show');
    Route::patch('/vendor-requests/{vendorRequest}/approve', [App\Http\Controllers\Admin\VendorRequestController::class, 'approve'])->name('vendor-requests.approve');
    Route::patch('/vendor-requests/{vendorRequest}/reject', [App\Http\Controllers\Admin\VendorRequestController::class, 'reject'])->name('vendor-requests.reject');
    // Payouts
    Route::get('/payouts', [App\Http\Controllers\Admin\PayoutController::class, 'index'])->name('payouts.index');
    Route::post('/payouts/{vendor}/process', [App\Http\Controllers\Admin\PayoutController::class, 'process'])->name('payouts.process');
});

require __DIR__.'/auth.php';