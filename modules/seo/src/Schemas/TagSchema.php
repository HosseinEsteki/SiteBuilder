<?php

namespace Seo\Schemas;

use Spatie\SchemaOrg\Schema;

class TagSchema
{
    public static function generate($tag, $articles): string
    {
        return Schema::collectionPage()
            ->name("Tag: {$tag->name}")
            ->description("Articles tagged with {$tag->name}")
            ->url(route('tags.show', $tag))
            ->mainEntity(
                Schema::itemList()
                    ->name("Articles for {$tag->name}")
                    ->itemListElement(
                        collect($articles)->map(function ($article, $index) {
                            return Schema::listItem()
                                ->position($index + 1)
                                ->url(route('articles.show', $article))
                                ->name($article->title);
                        })->toArray()
                    )
            )
            ->toScript();
    }
}
