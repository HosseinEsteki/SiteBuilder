<?php

namespace Ecommerce\Http\Controllers;

use Ecommerce\Http\Requests\Product\ProductStoreRequest;
use Ecommerce\Http\Requests\Product\ProductUpdateRequest;
use Ecommerce\Models\Product;

class ProductController
{
    /**
     * لیست همه محصولات
     */
    public function index()
    {
        return response()->json(Product::select('id','name','slug','price','stock')->get());
    }

    /**
     * نمایش یک محصول بر اساس slug
     */
    public function show(Product $product)
    {
        return response()->json([
            'id'          => $product->id,
            'name'        => $product->name,
            'slug'        => $product->slug,
            'description' => $product->description,
            'price'       => $product->formatted_price,
            'stock'       => $product->stock,
            'category_id' => $product->category_id,
            'brand_id'    => $product->brand_id,
        ]);
    }

    /**
     * ساخت محصول جدید
     */
    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->validated());

        if ($request->hasFile('logo')) {
            $product->clearMediaCollection('product');
            $product->addMediaFromRequest('logo')->toMediaCollection('product');
        }
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $product->addMedia($image)->toMediaCollection('products.gallery');
            }
        }
        return response()->json($product->load('media'), 201);
    }
    /**
     * بروزرسانی محصول
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update($request->validated());
        if ($request->hasFile('logo')) {
            $product->clearMediaCollection('product');
            $product->addMediaFromRequest('logo')->toMediaCollection('product');
        }
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $product->clearMediaCollection('products.gallery');
                $product->addMedia($image)->toMediaCollection('products.gallery');
            }
        }
        return response()->json($product);
    }

    /**
     * حذف محصول
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }

}
