<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Public\Models\Post;

class Article extends Post
{
    protected $table = 'blog_articles';
    public function __construct(array $attributes = [])
    {
        $appends=['logo_url'];
        $this->mergeAppends($appends);
        parent::__construct($attributes);
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('blog.article')->useDisk('public');
    }

    protected function logoUrl(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => $this->getFirstMediaUrl('blog.article', 'thumb'),
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
