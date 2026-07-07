<?php

namespace Ecommerce\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:ecommerce_categories,slug,' . $this->category->id,
            'logo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required|string',
        ];
    }
}
