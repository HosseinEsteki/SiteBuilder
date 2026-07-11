<?php
use Illuminate\Support\Facades\Route;
use Blog\Http\Controllers\ArticleController;
use Blog\Http\Controllers\CategoryController;

Route::prefix('blog')->group(function () {
    Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('categories', [CategoryController::class, 'index']);
});
