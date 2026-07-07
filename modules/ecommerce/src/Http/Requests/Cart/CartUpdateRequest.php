<?php

namespace Ecommerce\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CartUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'items'   => 'sometimes|array|min:1',
            'items.*.product_id' => 'required_with:items|exists:ecommerce_products,id',
            'items.*.quantity'   => 'required_with:items|integer|min:1',
        ];
    }
}
