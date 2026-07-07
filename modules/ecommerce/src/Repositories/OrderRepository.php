<?php

namespace Ecommerce\Repositories;

use Ecommerce\Models\Order;

class OrderRepository
{
    public function all()
    {
        return Order::all();
    }

    public function find(int $id): ?Order
    {
        return Order::find($id);
    }

    public function create(array $data): Order
    {
        return Order::create($data);
    }

    public function update(Order $order, array $data): Order
    {
        $order->update($data);
        return $order;
    }

    public function delete(Order $order): bool
    {
        return $order->delete();
    }
}
