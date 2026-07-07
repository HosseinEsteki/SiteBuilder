<?php

namespace Ecommerce\Http\Controllers;

use App\Http\Controllers\Controller;
use Ecommerce\Http\Requests\Coupon\CouponStoreRequest;
use Ecommerce\Http\Requests\Coupon\CouponUpdateRequest;
use Ecommerce\Models\Coupon;

class CouponController extends Controller
{
    public function index()
    {
        return Coupon::all();
    }

    public function store(CouponStoreRequest $request)
    {
        $data = $request->validate([

        ]);

        $coupon = Coupon::create($data);

        return response()->json($coupon, 201);
    }

    public function show(Coupon $coupon)
    {
        return $coupon;
    }

    public function update(CouponUpdateRequest $request, Coupon $coupon)
    {
        $data = $request->validated();

        $coupon->update($data);

        return response()->json($coupon);
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return response()->json(null, 204);
    }
}

