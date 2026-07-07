<?php

namespace Blog\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Public\Traits\HasAuthor;
use Illuminate\Database\Eloquent\Model;
use Public\Traits\HasPersianDate;
use Seo\Traits\HasSEO;

class Category extends Model
{
    use HasSEO, HasAuthor,HasPersianDate;

    protected $fillable = ['name', 'slug', 'description'];
    protected $appends=['articles_count'];

    protected $table = 'blog_categories';

    protected function articlesCount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->articles()->count(),
        );
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
