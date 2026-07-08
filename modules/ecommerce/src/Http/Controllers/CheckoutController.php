<?php

namespace Ecommerce\Http\Controllers;

use Ecommerce\Http\Requests\CheckoutRequest;
use Ecommerce\Models\Order;
use Ecommerce\Models\Product;
use Ecommerce\Services\DiscountService;
use Ecommerce\Services\PaymentService;

class CheckoutController
{
    public function __construct(
        protected DiscountService $discountService
    ) {}

    public function store(CheckoutRequest $request, PaymentService $paymentService)
    {
        $data = $request->validated();
        $cartItems = collect($data['items']);
        $originalTotal = $cartItems->sum(function (array $item) {
            return $item['quantity'] * Product::findOrFail($item['product_id'])->price;
        });

        $cart = new class($cartItems, $originalTotal) {
            public int $shipping_cost = 50000;

            public function __construct(
                public $items,
                public int|float $total
            ) {}

            public function total(): int|float
            {
                return $this->total;
            }

            public function itemsCount(): int
            {
                return $this->items->sum('quantity');
            }
        };

        $discountResult = $this->discountService->applyDiscounts($cart, $data['coupon'] ?? null);

        $order = Order::create([
            'user_id' => $data['user_id'],
            'status' => 'pending',
            'original_total' => $discountResult['original_total'],
            'discount' => $discountResult['discount'],
            'total_price' => $discountResult['final_total'],
            'total_shipping' => $cart->shipping_cost,
            'shipping_address' => $data['shipping']['address'],
            'shipping_code' => $data['shipping']['zip'],
            'shipping_user' => (string) $data['user_id'],
        ]);

        foreach ($data['items'] as $item) {
            $product = Product::findOrFail($item['product_id']);

            $order->items()->create([
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ]);
        }

        $payment = $paymentService->pay($order, $data['payment']['method']);

        return response()->json([
            'order' => $order->fresh()->load('items.product'),
            'payment' => [
                'authority_key' => $payment->authorityKey,
                'redirect_url' => $payment->redirectResponseUrl,
            ],
        ], 201);
    }
}
