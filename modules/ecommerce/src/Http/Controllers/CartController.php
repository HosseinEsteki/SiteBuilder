<?php

namespace Ecommerce\Http\Controllers;

use Ecommerce\Http\Requests\Cart\CartStoreRequest;
use Ecommerce\Http\Requests\Cart\CartUpdateRequest;
use Ecommerce\Models\Cart;
use Ecommerce\Models\Product;

class CartController
{
    /**
     * نمایش سبد خرید کاربر
     */
    public function show(int $userId)
    {
        $cart = Cart::with('items.product')->where('user_id', $userId)->firstOrFail();

        return response()->json($cart);
    }

    /**
     * ساخت سبد خرید جدید
     */
    public function store(CartStoreRequest $request)
    {
        $data = $request->validated();

        $cart = Cart::create([
            'user_id' => $data['user_id'],
        ]);

        foreach ($data['items'] as $item) {
            $cart->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => Product::find($item['product_id'])->price,
            ]);
        }

        return response()->json($cart->load('items.product'), 201);
    }

    /**
     * بروزرسانی سبد خرید
     */
    public function update(CartUpdateRequest $request, Cart $cart)
    {
        $data = $request->validated();

        if (isset($data['items'])) {
            $cart->items()->delete(); // پاک کردن آیتم‌های قبلی
            foreach ($data['items'] as $item) {
                $cart->items()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => Product::find($item['product_id'])->price,
                ]);
            }
        }

        return response()->json($cart->load('items.product'));
    }

    /**
     * حذف سبد خرید
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();

        return response()->json(['message' => 'Cart deleted']);
    }
}
