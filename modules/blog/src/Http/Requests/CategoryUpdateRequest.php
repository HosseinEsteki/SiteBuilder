<?php
namespace Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|unique:blog_categories,slug,' . optional($this->route('category'))->id,
            'keywords' => 'nullable|json',
            'description' => 'nullable|string',
        ];
    }
}
