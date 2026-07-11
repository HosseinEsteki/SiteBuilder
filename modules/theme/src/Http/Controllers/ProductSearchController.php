<?php

namespace Theme\Http\Controllers;

use Ecommerce\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductSearchController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $query = trim((string) $request->query('q', ''));

        if (mb_strlen($query) < 2) {
            return response()->json([]);
        }

        $products = Product::query()
            ->where(fn ($builder) => $builder->where('name', 'like', "%{$query}%")->orWhere('slug', 'like', "%{$query}%"))
            ->limit(8)
            ->get()
            ->map(fn (Product $product) => [
                'name' => $product->name,
                'url' => '#',
                'image' => $product->thumbnail_url,
                'price' => $product->formatted_price,
            ]);

        return response()->json($products);
    }
}
