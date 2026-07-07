<?php

namespace Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Blog\Http\Requests\CategoryStoreRequest;
use Blog\Http\Requests\CategoryUpdateRequest;
use Blog\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::with('articles')->get();
    }

    public function store(CategoryStoreRequest $request)
    {
        $data = $request->validated();

        $category = Category::create($data);

        return response()->json($category, 201);
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $data = $request->validated();

        $category->update($data);

        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Category deleted']);
    }
}
