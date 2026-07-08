<?php


namespace Ecommerce\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use IRPayment\Models\Concerns\Paymentable;
use Public\Helpers\AuthorHelper;
use Public\Traits\HasPersianDate;

class Order extends Model
{
    use HasFactory;
    use HasPersianDate;
    use Paymentable;
    protected $fillable = [
        'user_id',
        'status',
        'payment_ref',
        'original_total',
        'total_price',
        'discount',
        'total_shipping',
        'shipping_user',
        'shipping_address',
        'shipping_code',
        'description'
    ];
protected $table = 'ecommerce_orders';

    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->total_price,
        );
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }



    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
