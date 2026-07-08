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
            'method' => 'required_without:token|string|in:zarinpal,stripe,paypal',
            'token' => 'required_without:method|string|max:255',
        ];
    }
}
