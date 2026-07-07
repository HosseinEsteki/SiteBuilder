<?php

namespace Ecommerce\Services;

use Ecommerce\Repositories\CartRepository;
use Ecommerce\Models\Cart;
use Ecommerce\Models\Product;
use Ecommerce\Models\CartItem;

class CartService
{
    public function __construct(
        protected CartRepository $repository
    ) {}

    public function getUserCart(int $userId): ?Cart
    {
        return $this->repository->findByUser($userId);
    }

    public function addToCart(int $userId, Product $product, int $quantity = 1): CartItem
    {
        $cart = $this->repository->findByUser($userId);

        if (!$cart) {
            $cart = $this->repository->create(['user_id' => $userId]);
        }

        return $cart->items()->create([
            'product_id' => $product->id,
            'quantity'   => $quantity,
        ]);
    }

    public function removeFromCart(CartItem $item): bool
    {
        return $item->delete();
    }

    public function clearCart(Cart $cart): bool
    {
        return $cart->items()->delete();
    }
}
