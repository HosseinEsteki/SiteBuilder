<?php


namespace Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductVariant extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    protected $table = 'ecommerce_product_variants';

    protected $fillable = [
        'product_id',
        'price',
        'sale_price',
        'stock',
        'sku',
        'image',
        'discount_id',
    ];
    /*
    |--------------------------------------------------------------------------
    | Media Library
    |--------------------------------------------------------------------------
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
        $this->addMediaCollection('ecommerce.product.variant.thumbnail')
            ->singleFile()
            ->useDisk('public');
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->getFirstMediaUrl('ecommerce.product.variant.thumbnail', 'thumb');
    }

    /*
    |--------------------------------------------------------------------------
    | روابط
    |--------------------------------------------------------------------------
    */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function options()
    {
        return $this->belongsToMany(FeatureOption::class, 'ecommerce_variant_feature_options');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Mutators & Accessors
    |--------------------------------------------------------------------------
    */
    public function getFinalPriceAttribute()
    {
        if ($this->sale_price) {
            return $this->sale_price;
        }

        return $this->price;
    }
}
