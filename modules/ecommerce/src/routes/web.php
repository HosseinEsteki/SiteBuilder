<?php

use Ecommerce\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Ecommerce\Http\Controllers\CategoryController;
use Ecommerce\Http\Controllers\ProductController;

Route::middleware(['web'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/product-categories/{category:slug}', [CategoryController::class, 'show'])->name('product-categories.show');
    Route::prefix('test')->group(function () {

        Route::get('brands', function (Request $request) {
            $brands = Brand::query()->orderByDesc('id')->limit(6)->get();
            return view('test.brands', compact('brands'));
        })->name('test.brands');

        Route::get('brands/{brand}', function (Brand $brand) {
            $brands = Brand::query()->orderByDesc('id')->limit(6)->get();
            return view('test.brands', compact('brands','brand'));
        })->name('test.brands.edit');

    });
});
