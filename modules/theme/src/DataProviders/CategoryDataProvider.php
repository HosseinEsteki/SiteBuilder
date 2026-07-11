<?php

namespace Theme\DataProviders;

use Ecommerce\Models\Category;

class CategoryDataProvider
{
    public function provide(array $settings = []): array
    {
        $limit = min(24, max(1, (int) ($settings['limit'] ?? 8)));
        $categories = Category::published()->withCount('products')->orderBy('name')->limit($limit)->get();

        $categories->each(fn (Category $category) => $category->setRelation('themeChildren', collect()));

        return ['categories' => $categories];
    }
}
