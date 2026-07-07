<?php

namespace Ecommerce\Models;

use Blog\Models\Article;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Public\Enums\CommentStatus;
use Public\Helpers\AuthorHelper;
use Public\Traits\HasAuthor;
use Public\Traits\HasPersianDate;

class Comment extends Model
{
    use HasAuthor, HasPersianDate;

    protected $fillable = ['article_id', 'subject', 'comment', 'status'];
    protected $table = 'ecommerce_comments';

    protected function status(): Attribute
    {
        return Attribute::make(
            get: function ($value, array $attributes) {
                foreach (CommentStatus::cases() as $case) {
                    if (strcasecmp($case->name, $value) === 0) {
                        return $case->value;
                    }
                }
                return $value;
            },
            set: fn($value) => $value,
        );
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
