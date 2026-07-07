<?php

namespace Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // یا بررسی دسترسی کاربر
    }

    public function rules(): array
    {
        return [
            'order_id' => 'required|exists:ecommerce_orders,id',
            'method'   => 'required|string|in:zarinpal,stripe,paypal',
            'token'    => 'nullable|string|max:255', // برای verify لازم میشه
        ];
    }
}
