<?php

use Ecommerce\Http\Controllers\BrandController;
use Ecommerce\Http\Controllers\CartController;
use Ecommerce\Http\Controllers\CategoryController;
use Ecommerce\Http\Controllers\CheckoutController;
use Ecommerce\Http\Controllers\OrderController;
use Ecommerce\Http\Controllers\PaymentController;
use Ecommerce\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('ecommerce')->middleware('web')->group(function () {

    // Payment
    Route::prefix('payment')->group(function () {
        Route::post('/pay', [PaymentController::class, 'pay']);       // شروع پرداخت
        Route::post('/verify', [PaymentController::class, 'verify']); // تایید پرداخت
    });

    // Products
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);       // لیست محصولات
        Route::post('/', [ProductController::class, 'store']);      // ساخت محصول جدید
        Route::get('/{product}', [ProductController::class, 'show']); // نمایش محصول با slug
        Route::put('/{product}', [ProductController::class, 'update']); // بروزرسانی محصول
        Route::delete('/{product}', [ProductController::class, 'destroy']); // حذف محصول
    });

    // Categories
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('/{category}', [CategoryController::class, 'show']);
        Route::put('/{category}', [CategoryController::class, 'update']);
        Route::delete('/{category}', [CategoryController::class, 'destroy']);
    });

    Route::prefix('brands')->name('brand.')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('index');       // لیست برندها
        Route::post('/', [BrandController::class, 'store'])->name('store');      // ساخت برند جدید
        Route::get('/{brand}', [BrandController::class, 'show'])->name('show'); // نمایش برند با slug
        Route::put('/{brand}', [BrandController::class, 'update'])->name('update'); // بروزرسانی برند
        Route::delete('/{brand}', [BrandController::class, 'destroy'])->name('destroy'); // حذف برند
    });

    // Cart
    Route::prefix('carts')->name('cart.')->group(function () {
        Route::get('/{userId}', [CartController::class, 'show'])->name('show');   // نمایش سبد خرید کاربر
        Route::post('/', [CartController::class, 'store']);         // ساخت سبد خرید جدید
        Route::put('/{cart}', [CartController::class, 'update']);   // بروزرسانی سبد خرید
        Route::delete('/{cart}', [CartController::class, 'destroy']); // حذف سبد خرید
    });

    // Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index']);       // لیست سفارش‌ها
        Route::post('/', [OrderController::class, 'store']);      // ساخت سفارش جدید
        Route::get('/{order}', [OrderController::class, 'show']); // نمایش سفارش
        Route::put('/{order}', [OrderController::class, 'update']); // بروزرسانی سفارش
        Route::delete('/{order}', [OrderController::class, 'destroy']); // حذف سفارش
    });

    // Checkout
    Route::prefix('checkout')->group(function () {
        Route::post('/', [CheckoutController::class, 'store']);
    });

    // Discount
    Route::apiResource('discounts', \Ecommerce\Http\Controllers\DiscountController::class);

    //Coupons
    Route::apiResource('coupons', \Ecommerce\Http\Controllers\CouponController::class);

});
