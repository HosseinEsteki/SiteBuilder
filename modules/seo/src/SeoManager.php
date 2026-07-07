<?php


namespace Seo;

use App\Models\Organization;
use Blog\Models\Article;
use Ecommerce\Models\Category;
use Ecommerce\Models\Product;
use Seo\Services\MetaManager;
use Seo\Schemas\ArticleSchema;
use Seo\Schemas\ProductSchema;
use Seo\Schemas\OrganizationSchema;
use Seo\Schemas\CategorySchema;
use Seo\Schemas\TagSchema;
use Seo\Console\Commands\GenerateSitemap;
use Seo\Models\Redirect;
use Spatie\Tags\Tag;

class SeoManager
{
    protected MetaManager $meta;

    public function __construct(MetaManager $meta)
    {
        $this->meta = $meta;
    }

    /**
     * مدیریت متاتگ‌ها
     */
    public function meta(): MetaManager
    {
        return $this->meta;
    }

    /**
     * تولید اسکیما برای مدل‌ها
     */
    public function schema($model): string
    {
        if ($model instanceof Article) {
            return ArticleSchema::generate($model);
        }

        if ($model instanceof Product) {
            return ProductSchema::generate($model);
        }

        if ($model instanceof Organization) {
            return OrganizationSchema::generate($model);
        }

        if ($model instanceof Category) {
            return CategorySchema::generate($model, $model->products);
        }
        if ($model instanceof \Blog\Models\Category) {
            return CategorySchema::generate($model, $model->articles);
        }

        if ($model instanceof Tag) {
            return TagSchema::generate($model, $model->articles);
        }

        return '';
    }

    /**
     * تولید Sitemap
     */
    public function sitemap(): void
    {
        (new GenerateSitemap())->handle();
    }

    /**
     * مدیریت Redirectها
     */
    public function addRedirect(string $from, string $to, int $status = 301): Redirect
    {
        return Redirect::create([
            'from' => $from,
            'to' => $to,
            'status_code' => $status,
        ]);
    }
}
