<?php

namespace Ecommerce\Services;

use Ecommerce\Models\Product;
use Public\Enums\PostStatus;

class ProductDetailService
{
    public function resolve(Product $product, int $relatedLimit = 12): array
    {
        abort_unless($product->getRawOriginal('status') === PostStatus::Published->name, 404);
        $product->loadMissing(['brand', 'category', 'featureOptions.feature', 'media', 'tags']);

        $related = Product::query()->where('status', PostStatus::Published->name)
            ->whereKeyNot($product->getKey())->with(['brand', 'media'])
            ->when($product->category_id, fn ($query) => $query->orderByRaw('CASE WHEN category_id = ? THEN 0 ELSE 1 END', [$product->category_id]))
            ->latest()->limit(min(12, max(1, $relatedLimit)))->get();

        return ['product' => $product, 'relatedProducts' => $related];
    }
}
