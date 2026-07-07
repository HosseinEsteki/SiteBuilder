<?php
namespace Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // یا بررسی نقش کاربر
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'in:draft,published',
            'keywords' => 'nullable|json',
            'description' => 'nullable|string',
        ];
    }
}
