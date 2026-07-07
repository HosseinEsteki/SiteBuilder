<?php

namespace Ecommerce\Http\Controllers;

use Ecommerce\Http\Requests\Category\CategoryStoreRequest;
use Ecommerce\Http\Requests\Category\CategoryUpdateRequest;
use Ecommerce\Models\Category;

class CategoryController
{
    // نمایش یک دسته‌بندی بر اساس slug
    public function show(Category $category)
    {
        return response()->json([
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'logo'=>$category->logo,
            'description' => $category->description,
            'products' => $category->products()->select('id', 'name', 'slug', 'price')->get(),
        ]);
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
