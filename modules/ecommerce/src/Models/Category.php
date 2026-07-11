<?php

namespace Ecommerce\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Public\Helpers\AuthorHelper;
use Public\Traits\HasAuthor;
use Public\Traits\HasPersianDate;
use Seo\Traits\HasSEO;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model implements HasMedia
{
    use HasFactory;
    use HasSEO;
    use InteractsWithMedia;
    use HasAuthor;
    use HasPersianDate;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_published',
    ];

    protected $table = 'ecommerce_categories';

    protected $casts = ['is_published' => 'boolean'];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }


    protected function productCount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->products()->count(),
        );
    }

    /**
     * تعریف کانورژن‌ها برای تصاویر دسته
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200)
            ->sharpen(10);

        $this->addMediaConversion('preview')
            ->width(800)
            ->height(600);
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('ecommerce.category')->useDisk('public');
    }

    /**
     * گرفتن URL لوگو
     */
    public function getLogoUrlAttribute()
    {
        return $this->getFirstMediaUrl('ecommerce.category', 'thumb');
    }
}
