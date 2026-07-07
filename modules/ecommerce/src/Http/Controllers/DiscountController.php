<?php

namespace Ecommerce\Http\Controllers;

use App\Http\Controllers\Controller;
use Ecommerce\Http\Requests\Discount\DiscountStoreRequest;
use Ecommerce\Http\Requests\Discount\DiscountUpdateRequest;
use Ecommerce\Models\Discount;

class DiscountController extends Controller
{
    // لیست همه تخفیف‌ها
    public function index()
    {
        return Discount::all();
    }

    // ایجاد تخفیف جدید
    public function store(DiscountStoreRequest $request)
    {
        $data = $request->validated();

        $discount = Discount::create($data);

        return response()->json($discount, 201);
    }

    // نمایش یک تخفیف
    public function show(Discount $discount)
    {
        return $discount;
    }

    // ویرایش تخفیف
    public function update(DiscountUpdateRequest $request, Discount $discount)
    {
        $data = $request->validated();

        $discount->update($data);

        return response()->json($discount);
    }

    // حذف تخفیف
    public function destroy(Discount $discount)
    {
        $discount->delete();
        return response()->json(null, 204);
    }
}
