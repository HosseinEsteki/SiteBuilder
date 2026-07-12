<?php

namespace Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Blog\Http\Requests\ArticleStoreRequest;
use Blog\Http\Requests\ArticleUpdateRequest;
use Blog\Models\Article;
use Blog\Services\ArticleService;
use Public\Enums\PostStatus;
use Theme\Builder\ThemeRenderer;
use Theme\Services\ActiveThemeResolver;
use Theme\Services\TemplateResolver;
use Theme\ThemeContext;

class ArticleController extends Controller
{
    protected ArticleService $service;

    public function __construct(
        ArticleService $service,
        private readonly ActiveThemeResolver $themes,
        private readonly TemplateResolver $templates,
        private readonly ThemeRenderer $renderer,
    )
    {
        $this->service = $service;
    }

    public function themeIndex()
    {
        $articles = Article::query()
            ->where('status', PostStatus::Published->name)
            ->with(['category', 'tags'])
            ->latest()
            ->paginate(12);

        return $this->themeView('blog_archive', ['articles' => $articles, 'posts' => $articles]);
    }

    public function themeShow(string $slug)
    {
        $article = Article::query()
            ->where('slug', $slug)
            ->where('status', PostStatus::Published->name)
            ->with(['category', 'tags', 'media'])
            ->firstOrFail();

        return $this->themeView('article', ['article' => $article], $article->name, $article->description);
    }

    private function themeView(string $type, array $data, ?string $title = null, ?string $description = null)
    {
        $theme = $this->themes->resolve();
        abort_if($theme === null, 404);
        $template = $this->templates->resolve($theme, $type);
        abort_if($template === null, 404);
        $header = $this->templates->resolve($theme, 'header');
        $footer = $this->templates->resolve($theme, 'footer');

        return view('theme::templates.show', [
            'template' => $template,
            'themeContext' => new ThemeContext($theme, $header, $footer),
            'renderedContent' => $this->renderer->render($template->builder_data, $data),
            'renderedHeader' => $header ? $this->renderer->render($header->builder_data) : '',
            'renderedFooter' => $footer ? $this->renderer->render($footer->builder_data) : '',
            'metaTitle' => $title ?? $template->name,
            'metaDescription' => $description ?? $theme->description,
        ]);
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
