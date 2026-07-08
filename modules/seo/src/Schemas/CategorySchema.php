<?php

namespace Seo\Schemas;

use Spatie\SchemaOrg\Schema;

class CategorySchema
{
    public static function generate($category, $items): string
    {
        $basePath = str_starts_with($category->getTable(), 'ecommerce_')
            ? 'ecommerce/categories'
            : 'blog/categories';

        $itemList = Schema::itemList()
            ->name($category->name)
            ->description($category->description ?? '')
            ->url(url("/{$basePath}/{$category->slug}"));

        foreach ($items as $index => $item) {
            $itemPath = str_starts_with($item->getTable(), 'ecommerce_')
                ? 'ecommerce/products'
                : 'blog/articles';

            $itemList->itemListElement(
                Schema::listItem()
                    ->position($index + 1)
                    ->url(url("/{$itemPath}/{$item->slug}"))
                    ->name($item->title ?? $item->name)
            );
        }

        return $itemList->toScript();
    }
}
