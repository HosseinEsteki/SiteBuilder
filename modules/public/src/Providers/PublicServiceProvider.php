<?php

namespace Public\Providers;

use Illuminate\Support\ServiceProvider;

class PublicServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        // بارگذاری مایگریشن‌ها
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }
}
