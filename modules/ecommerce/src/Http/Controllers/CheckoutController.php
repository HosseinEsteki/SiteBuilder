<?php

namespace Ecommerce\Http\Controllers;

use Ecommerce\Http\Requests\CheckoutRequest;
use Ecommerce\Models\Order;
use Ecommerce\Models\Product;
use Ecommerce\Services\DiscountService;
use Ecommerce\Services\PaymentService;

class CheckoutController
{
    protected $discountService;

    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }

    /**
     * اجرای فرآیند Checkout
     */
    public function store(CheckoutRequest $request, PaymentService $paymentService)
    {
        $data = $request->validated();

        // 1. محاسبه مجموع اولیه سبد خرید
        $cartItems = collect($data['items']);
        $originalTotal = $cartItems->sum(fn ($item) =>
            $item['quantity'] * Product::find($item['product_id'])->price
        );

        // ساخت یک آبجکت ساده Cart برای سرویس تخفیف
        $cart = new class($cartItems, $originalTotal) {
            public $items;
            public $total;
            public $shipping_cost = 50000; // مثال: هزینه ارسال ثابت

            public function __construct($items, $total)
            {
                $this->items = $items;
                $this->total = $total;
            }

            public function total()
            {
                return $this->total;
            }

            public function itemsCount()
            {
                return $this->items->sum('quantity');
            }
        };

        // 2. اعمال تخفیف‌ها
        $couponCode = $data['coupon'] ?? null;
        $discountResult = $this->discountService->applyDiscounts($cart, $couponCode, $data['user_id']);

        // 3. ساخت سفارش با مبلغ نهایی
        $order = Order::create([
            'user_id' => $data['user_id'],
            'status' => 'pending',
            'original_total' => $discountResult['original_total'],
            'discount' => $discountResult['discount'],
            'total' => $discountResult['final_total'],
            'payment_ref' => $data['payment']['token'],
        ]);

        // 4. افزودن آیتم‌ها به سفارش
        foreach ($data['items'] as $item) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => Product::find($item['product_id'])->price,
            ]);
        }

        // 5. اجرای پرداخت
        $paymentResult = $paymentService->verify($order, true);

        // 6. پاسخ نهایی
        return response()->json([
            'order' => $order->load('items'),
            'payment' => $paymentResult ? 'success' : 'failed',
        ], 201);
    }
}
