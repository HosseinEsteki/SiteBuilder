<?php
namespace Blog\Services;

use Blog\Repositories\CategoryRepository;
use Blog\Models\Category;

class CategoryService
{
    protected CategoryRepository $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function listCategories()
    {
        return $this->repository->all();
    }

    public function createCategory(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateCategory(Category $category, array $data)
    {
        return $this->repository->update($category, $data);
    }

    public function deleteCategory(Category $category)
    {
        return $this->repository->delete($category);
    }
}
