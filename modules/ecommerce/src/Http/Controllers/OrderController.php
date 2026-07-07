<?php

namespace Ecommerce\Http\Controllers;

use Ecommerce\Http\Requests\Order\OrderStoreRequest;
use Ecommerce\Http\Requests\Order\OrderUpdateRequest;
use Ecommerce\Models\Order;
use Ecommerce\Models\Product;

class OrderController
{
    /**
     * لیست همه سفارش‌ها
     */
    public function index()
    {
        return response()->json(Order::with('items.product')->get());
    }

    /**
     * نمایش یک سفارش
     */
    public function show(Order $order)
    {
        return response()->json($order->load('items.product'));
    }

    /**
     * ساخت سفارش جدید
     */
    public function store(OrderStoreRequest $request)
    {
        $data = $request->validated();

        $order = Order::create([
            'user_id' => $data['user_id'],
            'status' => $data['status'],
            'total' => collect($data['items'])->sum(fn($item) => $item['quantity'] * Product::find($item['product_id'])->price
            ),
            'payment_ref' => $data['payment_ref'] ?? null,
        ]);

        foreach ($data['items'] as $item) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => Product::find($item['product_id'])->price,
            ]);
        }

        return response()->json($order->load('items.product'), 201);
    }

    /**
     * بروزرسانی سفارش
     */
    public function update(OrderUpdateRequest $request, Order $order)
    {
        $data = $request->validated();

        $order->update([
            'status' => $data['status'] ?? $order->status,
            'total' => $data['total'] ?? $order->total,
            'payment_ref' => $data['payment_ref'] ?? $order->payment_ref,
        ]);

        if (isset($data['items'])) {
            $order->items()->delete();
            foreach ($data['items'] as $item) {
                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => Product::find($item['product_id'])->price,
                ]);
            }
        }

        return response()->json($order->load('items.product'));
    }

    /**
     * حذف سفارش
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message' => 'Order deleted']);
    }

}
