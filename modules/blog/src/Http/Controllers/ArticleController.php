<?php

namespace Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Blog\Http\Requests\ArticleStoreRequest;
use Blog\Http\Requests\ArticleUpdateRequest;
use Blog\Models\Article;
use Blog\Services\ArticleService;

class ArticleController extends Controller
{
    protected ArticleService $service;

    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    // لیست مقالات
    public function index()
    {
        return $this->service->listArticles();
    }

    // نمایش جزئیات مقاله
    public function show($slug)
    {
        return Article::where('slug', $slug)
            ->with('category', 'tags')
            ->firstOrFail();
    }

    // ایجاد مقاله جدید
    public function store(ArticleStoreRequest $request)
    {
        $data = $request->validated();

        $article = Article::create([
            'name' => $data['name'],
            'content' => $data['content'],
            'category_id' => $data['category_id'] ?? null,
            'user_id' => auth()->id(),
            'status' => 'draft',
            'keywords' => $data['keywords'],
            'description' => $data['description'],
        ]);

        return response()->json($article, 201);
    }

    // بروزرسانی مقاله
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        $data = $request->validated();

        $article->update($data);

        return response()->json($article);
    }

    // حذف مقاله
    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json(['message' => 'Article deleted']);
    }
}
