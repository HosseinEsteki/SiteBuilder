<?php
namespace Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'article_id' => 'required|exists:blog_articles,id',
            'subject' => 'required|string|max:255',
            'comment' => 'required|string|max:1000',
        ];
    }
}
