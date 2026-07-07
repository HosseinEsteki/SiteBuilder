<?php

namespace Ecommerce\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // یا بررسی دسترسی کاربر
    }

    public function rules(): array
    {
        return [
            'user_id'     => 'required|exists:users,id',
            'status'      => 'required|in:pending,paid,failed',
            'total'       => 'required|numeric|min:0',
            'payment_ref' => 'nullable|string|max:255',
            'items'       => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:ecommerce_products,id',
            'items.*.quantity'   => 'required|integer|min:1',
            'items.*.price'      => 'required|numeric|min:0',
        ];
    }
}
