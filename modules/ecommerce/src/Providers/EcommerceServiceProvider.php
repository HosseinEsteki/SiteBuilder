<?php
namespace Ecommerce\Providers;

use Illuminate\Support\ServiceProvider;

class EcommerceServiceProvider extends ServiceProvider
{
    public function register()
    {
        // اینجا می‌تونی سرویس‌ها و ریپازیتوری‌ها رو bind کنی
    }

    public function boot(): void
    {
        // بارگذاری Route ها
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        // بارگذاری مایگریشن‌ها
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');

        // بارگذاری ویوها (اگر داشتی)
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ecommerce');

        // بارگذاری کانفیگ‌ها
        $this->mergeConfigFrom(__DIR__.'/../config/tags.php', 'tags');
        $this->mergeConfigFrom(__DIR__.'/../config/media-library.php', 'media-library');
        $this->mergeConfigFrom(__DIR__.'/../config/money.php', 'money');

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'ecommerce');

    }
}
