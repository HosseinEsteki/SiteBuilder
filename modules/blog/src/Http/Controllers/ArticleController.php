<?php

namespace Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Blog\Http\Requests\ArticleStoreRequest;
use Blog\Http\Requests\ArticleUpdateRequest;
use Blog\Models\Article;
use Blog\Services\ArticleService;
use Public\Enums\PostStatus;

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
        $article = Article::where('slug', $slug)
            ->where('status', PostStatus::Published->name)
            ->with('category', 'tags')
            ->firstOrFail();

        return response()->json([
            'id' => $article->id,
            'name' => $article->name,
            'slug' => $article->slug,
            'status' => $article->status,
            'category_id' => $article->category_id,
        ]);
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
            'status' => $data['status'] ?? PostStatus::Draft->name,
            'keywords' => $data['keywords'] ?? null,
            'description' => $data['description'] ?? null,
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
