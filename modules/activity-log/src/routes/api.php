<?php

use ActivityLog\Http\Controllers\ActivityLogController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/activity-log')->group(function () {
    Route::get('/', [ActivityLogController::class, 'index']);
    Route::get('/search', [ActivityLogController::class, 'search']);
    Route::get('/stats', [ActivityLogController::class, 'stats']);
});
