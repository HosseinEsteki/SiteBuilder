<?php

use Illuminate\Support\Facades\Route;
use Theme\Http\Controllers\ThemePageController;
use Theme\Http\Controllers\ProductSearchController;
use Theme\Http\Controllers\ThemeTemplateController;

/*
|--------------------------------------------------------------------------
| Theme Web Routes
|--------------------------------------------------------------------------
|
| Public theme page routes.
|
*/

Route::get('/pages/{slug}', [ThemePageController::class, 'show'])
    ->name('theme.pages.show');

Route::get('/', [ThemeTemplateController::class, 'homepage'])
    ->name('theme.homepage');
Route::get('/shop', [ThemeTemplateController::class, 'homepage'])->name('theme.shop');

Route::get('/theme/products/search', ProductSearchController::class)
    ->name('theme.product-search');

Route::middleware('auth')->group(function () {
    Route::get('/admin/theme/pages/{page}/preview', [ThemePageController::class, 'preview'])
        ->name('theme.pages.preview');
});
