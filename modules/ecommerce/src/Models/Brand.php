<?php

namespace Ecommerce\Models;

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

class Brand extends Model implements HasMedia
{
    use HasAuthor;
    use HasSEO;
    use HasFactory;
    use HasPersianDate;
    use InteractsWithMedia;

    public static $thumbnailMedia='ecommerce.brand';

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    protected $table = 'ecommerce_brands';


    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }


    /**
     * تعریف کانورژن‌ها برای تصاویر برند
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
        $this->addMediaCollection(static::$thumbnailMedia)->useDisk('public');
    }

    /**
     * گرفتن URL لوگو
     */
    public function getLogoUrlAttribute()
    {
        return $this->getFirstMediaUrl(static::$thumbnailMedia, 'thumb');
    }
}
