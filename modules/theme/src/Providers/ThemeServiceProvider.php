<?php

namespace Theme\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $configPath = __DIR__.'/../../config/theme.php';

        if (is_file($configPath)) {
            $this->mergeConfigFrom($configPath, 'theme');
        }
    }

    public function boot(): void
    {
        $this->loadModuleRoutes();

        $viewsPath = __DIR__.'/../../resources/views';
        if (is_dir($viewsPath)) {
            $this->loadViewsFrom($viewsPath, 'theme');
        }

        $migrationsPath = __DIR__.'/../../database/migrations';
        if (is_dir($migrationsPath)) {
            $this->loadMigrationsFrom($migrationsPath);
        }

        $translationsPath = __DIR__.'/../../resources/lang';
        if (is_dir($translationsPath)) {
            $this->loadTranslationsFrom($translationsPath, 'theme');
        }
    }

    private function loadModuleRoutes(): void
    {
        $webRoutes = __DIR__.'/../../routes/web.php';
        if (is_file($webRoutes)) {
            Route::middleware('web')->group($webRoutes);
        }

        $apiRoutes = __DIR__.'/../../routes/api.php';
        if (is_file($apiRoutes)) {
            Route::prefix('api/theme')
                ->middleware('api')
                ->group($apiRoutes);
        }
    }
}
