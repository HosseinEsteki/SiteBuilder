<?php

namespace Seo\Schemas;

use Spatie\SchemaOrg\Schema;

class CategorySchema
{
    public static function generate($category, $articles): string
    {
        $itemList = Schema::itemList()
            ->name($category->name)
            ->description($category->description ?? '')
            ->url(route('categories.show', $category));

        foreach ($articles as $index => $article) {
            $itemList->itemListElement(
                Schema::listItem()
                    ->position($index + 1)
                    ->url(route('articles.show', $article))
                    ->name($article->title)
            );
        }

        return $itemList->toScript();
    }
}
