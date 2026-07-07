<?php
namespace Blog\Services;

use Blog\Repositories\ArticleRepository;
use Blog\Models\Article;

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
