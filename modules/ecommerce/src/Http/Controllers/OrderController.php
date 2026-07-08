<?php

namespace Ecommerce\Http\Controllers;

use Ecommerce\Http\Requests\Order\OrderStoreRequest;
use Ecommerce\Http\Requests\Order\OrderUpdateRequest;
use Ecommerce\Models\Order;
use Ecommerce\Models\Product;

class OrderController
{
    public function index()
    {
        return response()->json(Order::with('items.product')->get());
    }

    public function show(Order $order)
    {
        return response()->json($order->load('items.product'));
    }

    public function store(OrderStoreRequest $request)
    {
        $data = $request->validated();
        $total = $data['total_price'] ?? $data['total'] ?? $this->calculateItemsTotal($data['items']);

        $order = Order::create([
            'user_id' => $data['user_id'],
            'status' => $data['status'],
            'original_total' => $total,
            'total_price' => $total,
            'payment_ref' => $data['payment_ref'] ?? null,
        ]);

        foreach ($data['items'] as $item) {
            $product = Product::findOrFail($item['product_id']);

            $order->items()->create([
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $item['price'] ?? $product->price,
            ]);
        }

        return response()->json($order->load('items.product'), 201);
    }

    public function update(OrderUpdateRequest $request, Order $order)
    {
        $data = $request->validated();

        $order->update([
            'status' => $data['status'] ?? $order->status,
            'total_price' => $data['total_price'] ?? $data['total'] ?? $order->total_price,
            'payment_ref' => $data['payment_ref'] ?? $order->payment_ref,
        ]);

        if (isset($data['items'])) {
            $order->items()->delete();

            foreach ($data['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);

                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'] ?? $product->price,
                ]);
            }
        }

        return response()->json($order->load('items.product'));
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json(['message' => 'Order deleted']);
    }

    private function calculateItemsTotal(array $items): int|float
    {
        return collect($items)->sum(function (array $item) {
            $product = Product::findOrFail($item['product_id']);

            return $item['quantity'] * ($item['price'] ?? $product->price);
        });
    }
}
