<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

/*
|--------------------------------------------------------------------------
| Web Routes - Silver Luxe (Website Trang Sức Bạc)
|--------------------------------------------------------------------------
*/

// 1. Trang chủ, Danh mục, Chi tiết sản phẩm & Tìm kiếm AJAX
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{slug}', [ProductController::class, 'category'])->name('category.show');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/ajax-search', [SearchController::class, 'ajaxSearch'])->name('ajax.search');

// 2. Auth Routes (Đăng ký / Đăng nhập / Đăng xuất)
Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// 3. Giỏ hàng (Cart)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// 4. Các chức năng cần Đăng nhập (Thanh toán, Lịch sử đơn hàng, Đánh giá)
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

    Route::get('/my-orders', [UserOrderController::class, 'history'])->name('orders.history');
    Route::get('/my-orders/{id}', [UserOrderController::class, 'detail'])->name('orders.detail');
    Route::post('/my-orders/{id}/cancel', [UserOrderController::class, 'cancel'])->name('orders.cancel');
    Route::post('/products/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

// 5. Nhóm Route Admin (Bảo vệ bởi Middleware 'auth' và 'checkAdmin')
Route::middleware(['auth', 'checkAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Quản lý Danh mục & Sản phẩm trang sức Admin
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('products', AdminProductController::class);

    // Quản lý Đơn hàng Admin
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});