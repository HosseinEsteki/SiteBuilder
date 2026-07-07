<?php

namespace AdminPanel\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class AdminPanelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // اگر کانفیگ‌های اختصاصی داری اینجا merge می‌شن
//        $this->mergeConfigFrom(__DIR__.'/../../config/admin-panel.php', 'admin-panel');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // بارگذاری مایگریشن‌ها
//        $this->loadMigrationsFrom(__DIR__.'/../../Database/migrations');
//
//        // بارگذاری ویوها
//        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin-panel');
//
//        // بارگذاری routeها
//        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
//
//        // ثبت صفحات و ویجت‌های فیلامنت
//        Filament::serving(function () {
//            // اینجا می‌تونی ویجت‌ها یا تنظیمات global فیلامنت رو اضافه کنی
//            Filament::registerNavigationGroups([
//                'Content Management',
//                'Shop Management',
//                'System',
//            ]);
//        });
    }
}
