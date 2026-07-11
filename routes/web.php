<?php

use Illuminate\Support\Facades\Route;

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::resource('organizations', \App\Http\Controllers\OrganizationController::class);
Route::get('test', function () {

    return view('theme.blog.noonPost.login');
}
);


require __DIR__ . '/auth.php';
