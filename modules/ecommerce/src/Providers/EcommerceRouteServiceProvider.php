<?php

namespace Ecommerce\Providers;

use Ecommerce\Models\Brand;
use Ecommerce\Models\Category;
use Ecommerce\Models\Product;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class EcommerceRouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        // تعریف binding برای slug
        Route::bind('product', function ($value) {
            return Product::query()->where('slug', $value)->orWhere('id', $value)->firstOrFail();
        });

        Route::bind('category', function ($value) {
            return Category::query()->where('slug', $value)->orWhere('id', $value)->firstOrFail();
        });

        Route::bind('brand', function ($value) {
            return Brand::query()->where('slug', $value)->orWhere('id', $value)->firstOrFail();
        });
    }

    public function map(): void
    {
        $this->mapEcommerceRoutes();
    }

    protected function mapEcommerceRoutes(): void
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../routes/api.php');
    }
}
