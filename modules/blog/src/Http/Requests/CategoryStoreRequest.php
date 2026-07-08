<?php
namespace Blog\Http\Requests;

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
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:blog_categories,slug',
            'keywords' => 'nullable|json',
            'description' => 'nullable|string',
        ];
    }
}
