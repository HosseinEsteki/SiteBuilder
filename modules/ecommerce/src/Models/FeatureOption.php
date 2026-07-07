<?php

namespace Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeatureOption extends Model
{
    use HasFactory;
    protected $table = 'ecommerce_feature_options';

    protected $fillable = [
        'feature_id',
        'value',
        'slug',
    ];

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'ecommerce_product_feature_options');
    }

    public function variants()
    {
        return $this->belongsToMany(ProductVariant::class, 'ecommerce_variant_feature_options');
    }
}
