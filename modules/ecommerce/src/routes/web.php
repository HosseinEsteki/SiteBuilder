<?php

use Ecommerce\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
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

