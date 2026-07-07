<?php

namespace Ecommerce\Services;

use Ecommerce\Models\Cart;
use Ecommerce\Models\Order;
use Ecommerce\Repositories\OrderRepository;

class OrderService
{
    public function __construct(
        protected OrderRepository $repository
    ) {}

    public function createOrderFromCart(Cart $cart): Order
    {
        $order = $this->repository->create([
            'user_id' => $cart->user_id,
            'status' => 'pending',
            'total' => $cart->items->sum(fn ($item) => $item->quantity * $item->product->price),
        ]);

        foreach ($cart->items as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        return $order;
    }

    public function updateOrderStatus(Order $order, string $status): Order
    {
        return $this->repository->update($order, ['status' => $status]);
    }

    public function cancelOrder(Order $order): Order
    {
        return $this->updateOrderStatus($order, 'cancelled');
    }
}
