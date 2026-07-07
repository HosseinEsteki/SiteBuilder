<?php

namespace Ecommerce\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CartStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'items'   => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:ecommerce_products,id',
            'items.*.quantity'   => 'required|integer|min:1',
        ];
    }
}
