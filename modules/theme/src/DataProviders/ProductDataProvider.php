<?php

namespace Theme\DataProviders;

use Ecommerce\Models\Product;
use Public\Enums\PostStatus;

class ProductDataProvider
{
    public function provide(array $settings = []): array
    {
        $limit = min(24, max(1, (int) ($settings['limit'] ?? 8)));
        $query = Product::query()->where('status', PostStatus::Published->name)->with('brand');

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

    public function related(Product $product, array $settings = []): array
    {
        $limit = min(12, max(1, (int) ($settings['limit'] ?? 4)));

        $products = Product::query()
            ->where('status', PostStatus::Published->name)
            ->whereKeyNot($product->getKey())
            ->with('brand')
            ->when($product->category_id, fn ($query) => $query
                ->orderByRaw('CASE WHEN category_id = ? THEN 0 ELSE 1 END', [$product->category_id]))
            ->latest()
            ->limit($limit)
            ->get();

        return ['products' => $products];
    }
}
