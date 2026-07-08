<?php

namespace Ecommerce\Http\Requests\Order;

use Ecommerce\Enums\OrderStatus;
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
            'status' => 'sometimes|required|in:' . implode(',', OrderStatus::values()),
            'total' => 'sometimes|required_without:total_price|numeric|min:0',
            'total_price' => 'sometimes|required_without:total|numeric|min:0',
            'payment_ref' => 'nullable|string|max:255',
            'items' => 'sometimes|array|min:1',
            'items.*.product_id' => 'required_with:items|exists:ecommerce_products,id',
            'items.*.quantity' => 'required_with:items|integer|min:1',
            'items.*.price' => 'nullable|numeric|min:0',
        ];
    }
}
