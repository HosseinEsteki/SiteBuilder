<?php

namespace Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id' => 'required|exists:ecommerce_orders,id',
            'method' => 'required_without_all:authority_key,payment_code|string|in:zarinpal,payping',
            'authority_key' => 'required_without_all:method,payment_code|string|max:100',
            'payment_code' => 'required_without_all:method,authority_key|string|max:100',
        ];
    }
}
