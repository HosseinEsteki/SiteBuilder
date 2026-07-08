<?php
namespace Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Public\Enums\PostStatus;

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
            'content' => 'sometimes',
            'category_id' => 'nullable|exists:blog_categories,id',
            'status' => 'nullable|in:' . implode(',', PostStatus::getNames()),
            'keywords' => 'nullable|json',
            'description' => 'nullable|string',
        ];
    }
}
