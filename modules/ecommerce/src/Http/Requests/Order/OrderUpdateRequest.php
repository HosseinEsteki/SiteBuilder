<?php

namespace Ecommerce\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status'      => 'sometimes|required|in:pending,paid,failed',
            'total'       => 'sometimes|required|numeric|min:0',
            'payment_ref' => 'nullable|string|max:255',
            'items'       => 'sometimes|array|min:1',
            'items.*.product_id' => 'required_with:items|exists:ecommerce_products,id',
            'items.*.quantity'   => 'required_with:items|integer|min:1',
            'items.*.price'      => 'required_with:items|numeric|min:0',
        ];
    }
}
