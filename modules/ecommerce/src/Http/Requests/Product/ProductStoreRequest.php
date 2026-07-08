<?php

namespace Ecommerce\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // یا بررسی دسترسی کاربر
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:ecommerce_products,slug',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:ecommerce_categories,id',
            'brand_id' => 'nullable|exists:ecommerce_brands,id',
            'logo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'gallery' => 'required|array',
            'gallery.*' => 'image|mimes:jpg,jpeg,png|max:2048',

        ];
    }
}
