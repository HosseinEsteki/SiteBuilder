<?php

use Illuminate\Support\Facades\Route;
use Theme\Http\Controllers\ThemePageController;

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

Route::middleware('auth')->group(function () {
    Route::get('/admin/theme/pages/{page}/preview', [ThemePageController::class, 'preview'])
        ->name('theme.pages.preview');
});
