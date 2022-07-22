<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Middleware\Authenticate;

// -------- QUẢN TRỊ ---------
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin');


        // CATEGORY
        Route::prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category');
            Route::get('/add', [CategoryController::class, 'create'])->name('category-add');
            Route::post('add', [CategoryController::class, 'store']);
            Route::get('edit/{category}', [CategoryController::class, 'edit'])->name('edit');
            Route::get('update/{category}', [CategoryController::class, 'update'])->name('update');
            Route::delete('delete/{catgories}', [CategoryController::class, 'delete'])->name('delete');
        });


        // PRODUCT
        Route::get('/product', function () {
            return view('admin.products.index');
        })->name('product');
    });
});






// ------- ĐĂNG NHẬP ------
Route::prefix('/login')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/store', [LoginController::class, 'store'])->name('store');
});

Route::prefix('/')->group(function () {
    Route::get('/trang-chu', function () {
        return view('page.homepage');
    })->name('home-page');
    Route::get('/san-pham', function () {
        return view('page.shop');
    })->name('shop');
    Route::get('/san-pham/detail', function () {
        return view('page.product-detail');
    })->name('detail');
    Route::get('/lien-he', function () {
        return view('page.contact');
    })->name('contact');
    Route::get('/gio-hang', function () {
        return view('page.cart');
    })->name('cart');

    // thanh toán
    Route::get('/thanh-toan', function () {
        return view('page.check-out');
    })->name('check-out');

    // đăng ký
    Route::get('/register', function () {
        return view('page.register');
    })->name('register-form');
});
