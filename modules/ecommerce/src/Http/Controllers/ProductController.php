<?php

namespace Ecommerce\Http\Controllers;

use Ecommerce\Http\Requests\Product\ProductStoreRequest;
use Ecommerce\Http\Requests\Product\ProductUpdateRequest;
use Ecommerce\Models\Product;
use Ecommerce\Services\ProductDetailService;
use Public\Enums\PostStatus;
use Theme\Builder\ThemeRenderer;
use Theme\Services\ActiveThemeResolver;
use Theme\Services\TemplateResolver;
use Theme\ThemeContext;

class ProductController
{
    public function __construct(
        private readonly ActiveThemeResolver $themes,
        private readonly TemplateResolver $templates,
        private readonly ThemeRenderer $renderer,
        private readonly ProductDetailService $productDetails,
    ) {
    }
    /**
     * لیست همه محصولات
     */
    public function index()
    {
        return response()->json(Product::where('status', PostStatus::Published->name)->select('id','name','slug','price','stock')->get());
    }

    /**
     * نمایش یک محصول بر اساس slug
     */
    public function show(Product $product)
    {
        $presentation = $this->productDetails->resolve($product);
        $theme = $this->themes->resolve();
        abort_if($theme === null, 404);

        $template = $this->templates->resolve($theme, 'product');
        abort_if($template === null, 404);

        $header = $this->templates->resolve($theme, 'header');
        $footer = $this->templates->resolve($theme, 'footer');

        return view('theme::templates.show', [
            'template' => $template,
            'themeContext' => new ThemeContext($theme, $header, $footer),
            'renderedContent' => $this->renderer->render($template->builder_data, $presentation),
            'renderedHeader' => $header ? $this->renderer->render($header->builder_data) : '',
            'renderedFooter' => $footer ? $this->renderer->render($footer->builder_data) : '',
            'metaTitle' => $product->name,
            'metaDescription' => $product->short_information ?? $product->description,
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
