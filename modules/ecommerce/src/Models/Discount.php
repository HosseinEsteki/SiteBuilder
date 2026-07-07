<?php

namespace Ecommerce\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Public\Helpers\AuthorHelper;
use Public\Traits\HasAuthor;

class Discount extends Model
{
    use HasFactory;
    use HasAuthor;
    protected $table = 'ecommerce_discounts';
    protected $fillable = [
        'title', 'type', 'value', 'start_date', 'end_date',
        'usage_limit', 'used_count', 'active'
    ];

    protected function casts(): array
    {
        return [
            'conditions' => 'json',
        ];
    }
    protected function conditions(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => json_decode($value),
            set: fn($value) => $value,
        );
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }


    public function discountables()
    {
        return $this->morphToMany(Product::class, 'discountable');
    }

}
