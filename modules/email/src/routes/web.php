<?php

use Illuminate\Support\Facades\Route;
use Email\Http\Controllers\EmailController;

Route::middleware('web')->group(function () {
    Route::post('/send-test-email', [EmailController::class, 'sendTest']);
});
