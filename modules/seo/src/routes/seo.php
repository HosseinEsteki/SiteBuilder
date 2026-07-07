<?php

use Illuminate\Support\Facades\Route;

Route::middleware('seo.redirect')->get('/seo/redirect', function () {
    return view('welcome');
});
