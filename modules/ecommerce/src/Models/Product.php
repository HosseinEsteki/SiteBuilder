<?php

namespace Ecommerce\Models;

use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Public\Models\Post;
use Public\Traits\HasAuthor;

class Product extends Post
{

    use HasFactory;

    protected $table = 'ecommerce_products';

    public static $thumbnailMedia='ecommerce.product.thumbnail';
    public static $galleryMedia='ecommerce.product.gallery';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $fillable = [
            'price',
            'sale_price',
            'stock',
            'brand_id',
            'is_variable',
        ];
        $this->mergeFillable($fillable);
        $appends = ['thumbnail_url', 'gallery_urls', 'formatted_price'];
        $this->mergeAppends($appends);
        $this->mergeCasts([
            'is_variable' => 'boolean',
        ]);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if ($model->sale_price == null)
                $model->sale_price = $model->price;
        });
    }

    /*
    |--------------------------------------------------------------------------
    | روابط محصول
    |--------------------------------------------------------------------------
    */

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    // ویژگی‌ها (Feature)
    public function features()
    {
        return $this->belongsToMany(Feature::class, 'ecommerce_product_features');
    }

    // مقدارهای ویژگی (FeatureOption)
    public function featureOptions()
    {
        return $this->belongsToMany(FeatureOption::class, 'ecommerce_product_feature_options');
    }

    // واریانت‌ها
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function isVariable(): bool
    {
        return $this->is_variable === true;
    }

    /*
    |--------------------------------------------------------------------------
    | Media Library
    |--------------------------------------------------------------------------
    */


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(static::$thumbnailMedia)
            ->singleFile()
            ->useDisk('public');

        $this->addMediaCollection(static::$galleryMedia)
            ->useDisk('public');

        $this->addMediaCollection('editorjs')
            ->useDisk('public');

    }

    /*
    |--------------------------------------------------------------------------
    | Mutators & Accessors
    |--------------------------------------------------------------------------
    */
    protected function thumbnailUrl(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => $this->getFirstMediaUrl('ecommerce.product.thumbnail', 'thumb'),
        );
    }

    protected function galleryUrls(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => $this->getMedia('ecommerce.product.gallery')
                ->map(fn($media) => $media->getUrl('thumb'))
                ->toArray(),
        );
    }

    protected function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: function ($value, array $attributes) {
                if ($this->isVariable()) {
                    $min = $this->variants()->min('price');
                    $max = $this->variants()->max('price');

                    return $min == $max
                        ? Money::parse($min)->format()
                        : Money::parse($min)->format() . ' - ' . Money::parse($max)->format();
                }

                return Money::parse($this->price)->format();
            },
        );
    }
}
