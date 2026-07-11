<?php

namespace Theme\DataProviders;

use Ecommerce\Models\Product;

class ProductDataProvider
{
    public function provide(array $settings = []): array
    {
        $limit = min(24, max(1, (int) ($settings['limit'] ?? 8)));
        $query = Product::query()->with('brand');

        if (! empty($settings['category_id'])) {
            $query->where('category_id', $settings['category_id']);
        }

        if (! empty($settings['brand_id'])) {
            $query->where('brand_id', $settings['brand_id']);
        }

        $sort = $settings['sort'] ?? 'latest';
        $sort === 'price_asc' ? $query->orderBy('price') : ($sort === 'price_desc' ? $query->orderByDesc('price') : $query->latest());

        return ['products' => $query->limit($limit)->get()];
    }
}
