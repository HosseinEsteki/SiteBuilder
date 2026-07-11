<?php

namespace Theme\DataProviders;

use Blog\Models\Article;

class BlogDataProvider
{
    public function provide(array $settings = []): array
    {
        $limit = min(12, max(1, (int) ($settings['limit'] ?? 4)));

        return ['posts' => Article::query()->latest()->limit($limit)->get()];
    }
}
