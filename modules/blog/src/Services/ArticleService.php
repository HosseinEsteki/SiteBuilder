<?php
namespace Blog\Services;

use Blog\Repositories\ArticleRepository;
use Blog\Models\Article;
use Public\Enums\PostStatus;

class ArticleService
{
    protected ArticleRepository $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function listArticles($perPage = 10)
    {
        return $this->repository->all($perPage);
    }

    public function getArticle(string $slug)
    {
        return $this->repository->findBySlug($slug);
    }

    public function archive(int $perPage = 12): array
    {
        $articles = Article::query()
            ->where('status', PostStatus::Published->name)
            ->with(['category', 'tags', 'media'])
            ->latest()
            ->paginate(min(24, max(1, $perPage)));

        return ['articles' => $articles, 'posts' => $articles];
    }

    public function published(string $slug): Article
    {
        return Article::query()
            ->where('slug', $slug)
            ->where('status', PostStatus::Published->name)
            ->with(['category', 'tags', 'media', 'author'])
            ->firstOrFail();
    }

    public function related(Article $article, int $limit = 3)
    {
        return Article::query()
            ->where('status', PostStatus::Published->name)
            ->whereKeyNot($article->getKey())
            ->when($article->category_id, fn ($query) => $query->where('category_id', $article->category_id))
            ->with(['category', 'media'])
            ->latest()
            ->limit(min(8, max(1, $limit)))
            ->get();
    }

    public function createArticle(array $data, int $userId)
    {
        $data['user_id'] = $userId;
        $data['status'] = $data['status'] ?? 'draft';
        return $this->repository->create($data);
    }

    public function updateArticle(Article $article, array $data)
    {
        return $this->repository->update($article, $data);
    }

    public function deleteArticle(Article $article)
    {
        return $this->repository->delete($article);
    }
}
