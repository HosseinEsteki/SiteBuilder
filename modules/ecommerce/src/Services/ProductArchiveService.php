<?php

namespace Ecommerce\Services;

use Ecommerce\Models\Brand;
use Ecommerce\Models\Category;
use Ecommerce\Models\Product;
use Illuminate\Http\Request;
use Public\Enums\PostStatus;

class ProductArchiveService
{
    public const SORTS = ['newest' => 'جدیدترین', 'price_asc' => 'ارزان‌ترین', 'price_desc' => 'گران‌ترین', 'discounted' => 'بیشترین تخفیف', 'title' => 'نام محصول'];

    public function build(Request $request, ?Category $category = null): array
    {
        return $this->buildQuery($request, $category);
    }

    public function search(Request $request): array
    {
        return $this->buildQuery($request, null, trim((string) $request->query('q', '')));
    }

    private function buildQuery(Request $request, ?Category $category = null, ?string $search = null): array
    {
        $category?->loadMissing('media');
        $filters = $request->validate([
            'q' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255', 'brand' => 'nullable|string|max:255',
            'min_price' => 'nullable|numeric|min:0', 'max_price' => 'nullable|numeric|min:0',
            'availability' => 'nullable|in:in_stock', 'discounted' => 'nullable|boolean',
            'sort' => 'nullable|in:'.implode(',', array_keys(self::SORTS)),
        ]);
        $query = Product::query()->where('status', PostStatus::Published->name)
            ->with(['brand', 'category', 'media']);
        $query->where(fn ($q) => $q->whereNull('category_id')->orWhereHas('category', fn ($categoryQuery) => $categoryQuery->published()))
            ->where(fn ($q) => $q->whereNull('brand_id')->orWhereHas('brand', fn ($brandQuery) => $brandQuery->published()));
        if ($search !== null && $search !== '') {
            $escaped = addcslashes($search, '\\%_');
            $like = "%{$escaped}%";
            $query->where(function ($q) use ($like) {
                $q->where('name', 'like', $like)->orWhere('slug', 'like', $like)
                    ->orWhere('content', 'like', $like)
                    ->orWhereHas('brand', fn ($brand) => $brand->published()->where('name', 'like', $like))
                    ->orWhereHas('category', fn ($category) => $category->published()->where('name', 'like', $like))
                    ->orWhereHas('variants', fn ($variant) => $variant->where('sku', 'like', $like));
            });
        } elseif ($search !== null) {
            $query->whereRaw('1 = 0');
        }
        $query->when($category, fn ($q) => $q->whereBelongsTo($category));
        $query->when(!$category && ($filters['category'] ?? null), fn ($q, $slug) => $q->whereHas('category', fn ($c) => $c->published()->where('slug', $slug)));
        $query->when($filters['brand'] ?? null, fn ($q, $slug) => $q->whereHas('brand', fn ($b) => $b->published()->where('slug', $slug)));
        $query->when(isset($filters['min_price']), fn ($q) => $q->where('sale_price', '>=', $filters['min_price']));
        $query->when(isset($filters['max_price']), fn ($q) => $q->where('sale_price', '<=', $filters['max_price']));
        $query->when(($filters['availability'] ?? null) === 'in_stock', fn ($q) => $q->where('stock', '>', 0));
        $query->when($filters['discounted'] ?? false, fn ($q) => $q->whereColumn('sale_price', '<', 'price'));
        match ($filters['sort'] ?? 'newest') {
            'price_asc' => $query->orderBy('sale_price'), 'price_desc' => $query->orderByDesc('sale_price'),
            'discounted' => $query->orderByRaw('(price - sale_price) DESC'), 'title' => $query->orderBy('name'),
            default => $query->latest(),
        };
        $products = $query->paginate(12)->withQueryString();
        return ['products' => $products, 'currentCategory' => $category, 'searchQuery' => $search,
            'archiveTitle' => $search !== null ? 'نتایج جستجو' : ($category?->name ?? 'فروشگاه'),
            'archiveDescription' => $category?->description,
            'archiveImage' => $category?->logo_url ?: null,
            'categories' => Category::published()->withCount(['products' => fn ($q) => $q->where('status', PostStatus::Published->name)])->orderBy('name')->limit(24)->get(),
            'brands' => Brand::published()->orderBy('name')->limit(50)->get(), 'sortingOptions' => self::SORTS,
            'activeFilters' => $filters, 'resultCount' => $products->total(),
            'canonicalSearchUrl' => route('theme.product-search')];
    }
}
