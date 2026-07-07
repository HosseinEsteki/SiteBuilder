<?php
namespace Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'in:draft,published',
            'keywords' => 'nullable|json',
            'description' => 'nullable|string',
        ];
    }
}
