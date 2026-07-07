<?php

namespace Seo\Traits;

use App\Models\Organization;
use Blog\Models\Article;
use Ecommerce\Models\Product;
use Seo\Schemas\ArticleSchema;
use Seo\Schemas\ProductSchema;
use Seo\Schemas\OrganizationSchema;

trait HasSchema
{
    public function generateSchema(): string
    {
        if ($this instanceof Article) {
            return ArticleSchema::generate($this);
        }

        if ($this instanceof Product) {
            return ProductSchema::generate($this);
        }

        if ($this instanceof Organization) {
            return OrganizationSchema::generate($this);
        }

        return '';
    }
}
