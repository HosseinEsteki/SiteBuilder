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
            ->url(url('/tags/'.$tag->slug))
            ->mainEntity(
                Schema::itemList()
                    ->name("Articles for {$tag->name}")
                    ->itemListElement(
                        collect($articles)->map(function ($article, $index) {
                            return Schema::listItem()
                                ->position($index + 1)
                                ->url(url('/blog/articles/'.$article->slug))
                                ->name($article->title);
                        })->toArray()
                    )
            )
            ->toScript();
    }
}
