<?php

namespace Ecommerce\Http\Controllers;

use Ecommerce\Http\Requests\Brand\BrandStoreRequest;
use Ecommerce\Http\Requests\Brand\BrandUpdateRequest;
use Ecommerce\Models\Brand;

class BrandController
{
    /**
     * لیست همه برندها
     */
    public function index()
    {
        return response()->json(Brand::select('id', 'name', 'slug')->get());
    }

    /**
     * نمایش یک برند بر اساس slug
     */
    public function show(Brand $brand)
    {
        return response()->json([
            'id' => $brand->id,
            'name' => $brand->name,
            'slug' => $brand->slug,
            'logo' => $brand->logo,
            'products' => $brand->products()->select('id', 'name', 'slug', 'price')->get(),
        ]);
    }

    /**
     * ساخت برند جدید
     */
    public function store(BrandStoreRequest $request)
    {
        $brand = Brand::create($request->validated());
        if ($request->hasFile('logo')) {
            $brand->addMediaFromRequest('logo')->toMediaCollection('brand');
        }

        return response()->json($brand->load('media'), 201);
    }

    /**
     * بروزرسانی برند
     */
    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        $brand->update($request->validated());
        if ($request->hasFile('logo')) {
            $brand->clearMediaCollection('brand');
            $brand->addMediaFromRequest('logo')->toMediaCollection('brand');
        }

        return response()->json($brand->load('media'));

    }

    /**
     * حذف برند
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->json(['message' => 'Brand deleted']);
    }
}
