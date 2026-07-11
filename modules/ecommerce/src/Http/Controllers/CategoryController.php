<?php

namespace Ecommerce\Http\Controllers;

use Ecommerce\Http\Requests\Category\CategoryStoreRequest;
use Ecommerce\Http\Requests\Category\CategoryUpdateRequest;
use Ecommerce\Models\Category;
use Ecommerce\Services\ProductArchiveService;
use Illuminate\Http\Request;
use Theme\Http\Controllers\ThemeTemplateController;

class CategoryController
{
    // نمایش یک دسته‌بندی بر اساس slug
    public function show(Request $request, Category $category, ProductArchiveService $archive, ThemeTemplateController $themes)
    {
        abort_unless($category->is_published, 404);
        return $themes->archiveView('product_category', $archive->build($request, $category));
    }

    // لیست همه دسته‌بندی‌ها
    public function index()
    {
        return response()->json(Category::select('id', 'name', 'slug')->get());
    }

    // ساخت دسته‌بندی جدید
    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create($request->validated());
        if ($request->hasFile('logo')) {
            $category->addMediaFromRequest('logo')->toMediaCollection('category');
        }

        return response()->json($category->load('media'), 201);
    }

    // بروزرسانی دسته‌بندی
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->validated());
        if ($request->hasFile('logo')) {
            $category->clearMediaCollection('category');
            $category->addMediaFromRequest('logo')->toMediaCollection('category');
        }
        return response()->json($category->load('media'));
    }

    // حذف دسته‌بندی
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['message' => 'Category deleted']);
    }
}
