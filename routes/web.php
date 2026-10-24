<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

// 1. Route Đăng ký / Đăng nhập / Đăng xuất
Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// 2. Nhóm Route Admin được bảo vệ bởi Middleware 'auth' và 'admin'
Route::middleware(['auth', 'checkAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

// Quản lý danh mục trang sức
    Route::resource('categories', CategoryController::class);
    
    // Quản lý sản phẩm trang sức
    Route::resource('products', ProductController::class);
});