<?php

namespace Theme\DataProviders;

use Blog\Models\Article;
use Public\Enums\PostStatus;

class BlogDataProvider
{
    public function provide(array $settings = []): array
    {
        $limit = min(12, max(1, (int) ($settings['limit'] ?? 4)));

        return ['posts' => Article::query()->where('status', PostStatus::Published->name)->latest()->limit($limit)->get()];
    }

    public function archive(array $settings, array $context): array
    {
        return ['articles' => $context['articles'] ?? collect()];
    }

    public function related(array $settings, array $context): array
    {
        return ['articles' => $context['relatedArticles'] ?? collect()];
    }
}
