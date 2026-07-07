<?php

namespace Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Public\Helpers\AuthorHelper;
use Public\Traits\HasAuthor;
use Public\Traits\HasPersianDate;

class Shipping extends Model
{
    use HasPersianDate;
    use HasAuthor;
    protected $table = 'ecommerce_shippings';
    protected $fillable=[
        'name',
        'active',
        'cost',
        'description',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


}
