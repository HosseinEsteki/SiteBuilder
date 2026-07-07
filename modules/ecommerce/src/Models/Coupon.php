<?php

namespace Ecommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'ecommerce_coupons';
    protected $fillable = ['code', 'discount_id', 'usage_limit', 'used_count'];

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

}
