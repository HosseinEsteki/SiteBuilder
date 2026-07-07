<?php
use Illuminate\Support\Facades\Route;
use Blog\Http\Controllers\ArticleController;
use Blog\Http\Controllers\CategoryController;
use Blog\Http\Controllers\CommentController;

Route::prefix('api/blog')->group(function () {
    Route::get('articles', [ArticleController::class, 'index']);
    Route::get('articles/{slug}', [ArticleController::class, 'show']);
    Route::post('articles', [ArticleController::class, 'store']);
    Route::put('articles/{article}', [ArticleController::class, 'update']);
    Route::delete('articles/{article}', [ArticleController::class, 'destroy']);

    Route::post('categories', [CategoryController::class, 'store']);
    Route::put('categories/{category}', [CategoryController::class, 'update']);
    Route::delete('categories/{category}', [CategoryController::class, 'destroy']);

    Route::post('comments', [CommentController::class, 'store']);
    Route::post('comments/{comment}/approve', [CommentController::class, 'approve']);
    Route::post('comments/{comment}/reject', [CommentController::class, 'reject']);
});
