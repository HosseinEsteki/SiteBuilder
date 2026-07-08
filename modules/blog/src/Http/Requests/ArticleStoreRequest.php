<?php
namespace Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Public\Enums\PostStatus;

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
            'content' => 'required',
            'category_id' => 'nullable|exists:blog_categories,id',
            'status' => 'nullable|in:' . implode(',', PostStatus::getNames()),
            'keywords' => 'nullable|json',
            'description' => 'nullable|string',
        ];
    }
}
