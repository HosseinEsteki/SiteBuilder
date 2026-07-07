<?php

namespace Ecommerce\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class BrandUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:ecommerce_brands,slug,'.$this->brand->id,
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
