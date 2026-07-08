<?php

namespace Ecommerce\Http\Requests\Order;

use Ecommerce\Enums\OrderStatus;
use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:' . implode(',', OrderStatus::values()),
            'total' => 'nullable|numeric|min:0',
            'total_price' => 'nullable|numeric|min:0',
            'payment_ref' => 'nullable|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:ecommerce_products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'nullable|numeric|min:0',
        ];
    }
}
