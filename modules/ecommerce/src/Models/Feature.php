<?php


namespace Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Public\Helpers\AuthorHelper;

class Feature extends Model
{
    use HasFactory;
    protected $table='ecommerce_features';

    protected $fillable = [
        'name',
        'slug',
    ];

    public function options()
    {
        return $this->hasMany(FeatureOption::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'ecommerce_product_features');
    }
}
