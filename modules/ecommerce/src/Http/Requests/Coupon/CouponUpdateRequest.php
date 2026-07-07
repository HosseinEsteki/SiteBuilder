<?php

namespace Ecommerce\Http\Requests\Coupon;

use Illuminate\Foundation\Http\FormRequest;

class CouponUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'code' => 'sometimes|string|unique:coupons,code,' . $this->id,
            'discount_id' => 'sometimes|exists:discounts,id',
            'usage_limit' => 'nullable|integer',
        ];
    }
}
