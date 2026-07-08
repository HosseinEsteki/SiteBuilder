<?php

namespace Seo\Providers;

use Seo\Console\Commands\GenerateSitemap;
use Illuminate\Support\ServiceProvider;
use Artesaos\SEOTools\Facades\SEOTools;
use Seo\Jobs\Middleware\RedirectMiddleware;
use Seo\Models\Redirect;
use Seo\SeoManager;
use Seo\Services\MetaManager;
use Spatie\SchemaOrg\Schema;
use Spatie\Sitemap\SitemapGenerator;
use Illuminate\Routing\Router;
use Illuminate\Console\Scheduling\Schedule;




class SeoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(Router $router): void
    {
        // انتشار فایل‌های کانفیگ
        $this->publishes([
            __DIR__ . '/../config/seo.php' => config_path('seo.php'),
        ], 'config');

        // بارگذاری روت‌ها (در صورت نیاز)
        $this->loadRoutesFrom(__DIR__ . '/../routes/seo.php');

        // بارگذاری ویوها
        $viewsPath = __DIR__ . '/../resources/views';
        if (is_dir($viewsPath)) {
            $this->loadViewsFrom($viewsPath, 'seo');
        }

        // بارگذاری مایگریشن‌ها
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        //بارگذاری میدل ورها
        $router->aliasMiddleware('seo.redirect', RedirectMiddleware::class);

        // بارگذاری Command
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateSitemap::class,
            ]);
        }
        // اتصال به Scheduler
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);

            $schedule->command('seo:generate-sitemap')->daily();
        });


    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('seo', function ($app) {
            return new SeoManager(new MetaManager());
        });

        // رجیستر کردن سرویس‌های مورد نیاز
        $this->app->singleton('seo-tools', function () {
            return SEOTools::class;
        });

        $this->app->singleton('schema-org', function () {
            return Schema::class;
        });

        $this->app->singleton('sitemap-generator', function () {
            return SitemapGenerator::class;
        });

        $this->app->singleton('redirects', function () {
            return Redirect::class;
        });
    }
}
