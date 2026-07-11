<?php

use Illuminate\Support\Facades\Route;

beforeEach(function () {
    Route::get('/theme-home', fn () => '')->name('theme.homepage');
    Route::get('/category/{category}', fn () => '')->name('product-categories.show');
});

it('renders the announcement bar contract', function () {
    $html = view('theme::blocks.announcement-bar', ['settings' => ['enabled' => true, 'background_color' => '#111111', 'text_color' => '#ffffff', 'text' => 'ارسال رایگان', 'url' => '/offer']])->render();
    expect($html)->toContain('theme-announcement')->toContain('ارسال رایگان')->toContain('/offer');
});

it('renders desktop and mobile logo variants', function () {
    $html = view('theme::blocks.site-logo', ['settings' => ['width' => 180, 'desktop_logo' => '/desktop.svg', 'mobile_logo' => '/mobile.svg']])->render();
    expect($html)->toContain('theme-site-logo__desktop')->toContain('theme-site-logo__mobile')->toContain('--logo-width:180px');
});

it('renders authenticated and guest account actions', function () {
    $guest = view('theme::blocks.account-action')->render();
    expect($guest)->toContain('ورود')->toContain('ثبت‌نام');
});

it('renders mobile header cart count', function () {
    $html = view('theme::blocks.mobile-header', ['settings' => [], 'cartCount' => 4])->render();
    expect($html)->toContain('theme-mobile-header')->toContain('4')->toContain('سبد خرید');
});
