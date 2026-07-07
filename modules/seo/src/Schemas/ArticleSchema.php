<?php

namespace Seo\Schemas;

use Spatie\SchemaOrg\Schema;

class ArticleSchema
{
    public static function generate($article): string
    {
        return Schema::article()
            ->headline($article->title)
            ->description($article->excerpt ?? $article->description)
            ->author($article->author->name ?? 'Unknown')
            ->datePublished($article->created_at->toIso8601String())
            ->dateModified($article->updated_at->toIso8601String())
            ->image($article->image_url ?? asset('default.jpg'))
            ->url(route('articles.show', $article))
            ->toScript();
    }
}
