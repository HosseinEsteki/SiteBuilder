<?php

namespace Ecommerce\Repositories;

use Ecommerce\Models\Cart;

class CartRepository
{
    public function findByUser(int $userId): ?Cart
    {
        return Cart::where('user_id', $userId)->first();
    }

    public function create(array $data): Cart
    {
        return Cart::create($data);
    }

    public function update(Cart $cart, array $data): Cart
    {
        $cart->update($data);
        return $cart;
    }

    public function delete(Cart $cart): bool
    {
        return $cart->delete();
    }
}
