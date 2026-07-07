<?php
namespace Blog\Repositories;

use Blog\Models\Category;

class CategoryRepository
{
    public function all()
    {
        return Category::with('articles')->get();
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update(Category $category, array $data)
    {
        $category->update($data);
        return $category;
    }

    public function delete(Category $category)
    {
        return $category->delete();
    }
}
