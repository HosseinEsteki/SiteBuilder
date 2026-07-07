<?php

namespace Ecommerce\Repositories;

use Ecommerce\Models\Brand;

class BrandRepository
{
    public function all()
    {
        return Brand::all();
    }

    public function find(int $id): ?Brand
    {
        return Brand::find($id);
    }

    public function create(array $data): Brand
    {
        return Brand::create($data);
    }

    public function update(Brand $brand, array $data): Brand
    {
        $brand->update($data);
        return $brand;
    }

    public function delete(Brand $brand): bool
    {
        return $brand->delete();
    }
}
