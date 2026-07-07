<?php

namespace Ecommerce\Http\Requests\Coupon;

use Ecommerce\Enums\DiscountType;
use Illuminate\Foundation\Http\FormRequest;

class CouponStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'code' => 'required|string|unique:coupons',
            'discount_id' => 'required|exists:discounts,id',
            'usage_limit' => 'nullable|integer',
        ];
    }
}
