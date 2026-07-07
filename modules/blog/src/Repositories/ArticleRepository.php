<?php
namespace Blog\Repositories;

use Blog\Models\Article;

class ArticleRepository
{
    public function all($perPage = 10)
    {
        return Article::with('category', 'tags')->paginate($perPage);
    }

    public function findBySlug(string $slug)
    {
        return Article::where('slug', $slug)->with('category', 'tags')->firstOrFail();
    }

    public function create(array $data)
    {
        return Article::create($data);
    }

    public function update(Article $article, array $data)
    {
        $article->update($data);
        return $article;
    }

    public function delete(Article $article)
    {
        return $article->delete();
    }
}
