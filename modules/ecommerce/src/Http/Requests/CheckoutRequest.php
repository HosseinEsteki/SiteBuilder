<?php

namespace Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // یا بررسی دسترسی کاربر
    }

    public function rules(): array
    {
        return [
            // اطلاعات کاربر
            'user_id' => 'required|exists:users,id',

            // آیتم‌های سبد خرید
            'items'   => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:ecommerce_products,id',
            'items.*.quantity'   => 'required|integer|min:1',

            // اطلاعات پرداخت
            'payment.method' => 'required|string|in:zarinpal,payping',

            // آدرس ارسال (اختیاری یا اجباری بسته به پروژه)
            'shipping.address' => 'required|string|max:500',
            'shipping.city'    => 'required|string|max:255',
            'shipping.zip'     => 'required|string|max:20',
        ];
    }
}
