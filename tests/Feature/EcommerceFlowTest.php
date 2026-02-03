<?php


namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ecommerce\Models\Product;
use Ecommerce\Models\Cart;
use Ecommerce\Models\Order;
use Ecommerce\Services\CartService;
use Ecommerce\Services\OrderService;
use Ecommerce\Services\PaymentService;
use App\Models\User;

class EcommerceFlowTest extends TestCase
{
    use RefreshDatabase;

    protected CartService $cartService;
    protected OrderService $orderService;
    protected PaymentService $paymentService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->cartService = app(CartService::class);
        $this->orderService = app(OrderService::class);
        $this->paymentService = app(PaymentService::class);
    }

    /** @test */
    public function user_can_checkout_and_pay_successfully()
    {
        // 1. ساخت کاربر و محصول
        $user = User::factory()->create();
        $product = Product::factory()->create(['price' => 100]);

        // 2. افزودن محصول به سبد خرید
        $this->cartService->addToCart($user->id, $product, 2);
        $cart = $this->cartService->getUserCart($user->id);

        $this->assertCount(1, $cart->items);
        $this->assertEquals(200, $cart->items->sum(fn($i) => $i->quantity * $i->product->price));

        // 3. ساخت سفارش از سبد خرید
        $order = $this->orderService->createOrderFromCart($cart);

        $this->assertEquals('pending', $order->status);
        $this->assertEquals(200, $order->total);
        $this->assertCount(1, $order->items);

        // 4. شبیه‌سازی پرداخت موفق
        // در تست واقعی می‌توانیم PaymentService را mock کنیم
        $order->update(['status' => 'paid']);

        $this->assertEquals('paid', $order->fresh()->status);
    }

    /** @test */
    public function user_payment_can_fail()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['price' => 50]);

        $this->cartService->addToCart($user->id, $product, 1);
        $cart = $this->cartService->getUserCart($user->id);

        $order = $this->orderService->createOrderFromCart($cart);

        // شبیه‌سازی شکست پرداخت
        $order->update(['status' => 'failed']);

        $this->assertEquals('failed', $order->fresh()->status);
    }

    /** @test */
    public function user_can_checkout_and_pay_successfully_with_mock()
    {
        $user = \App\Models\User::factory()->create();
        $product = \Ecommerce\Models\Product::factory()->create(['price' => 100]);

        $cartService = app(\Ecommerce\Services\CartService::class);
        $orderService = app(\Ecommerce\Services\OrderService::class);
        $paymentService = new \Ecommerce\Services\MockPaymentService();

        // افزودن محصول به سبد
        $cartService->addToCart($user->id, $product, 2);
        $cart = $cartService->getUserCart($user->id);

        // ساخت سفارش
        $order = $orderService->createOrderFromCart($cart);

        // شبیه‌سازی پرداخت موفق
        $result = $paymentService->verify($order, true);

        $this->assertTrue($result);
        $this->assertEquals('paid', $order->fresh()->status);
    }

    /** @test */
    public function user_payment_can_fail_with_mock()
    {
        $user = \App\Models\User::factory()->create();
        $product = \Ecommerce\Models\Product::factory()->create(['price' => 50]);

        $cartService = app(\Ecommerce\Services\CartService::class);
        $orderService = app(\Ecommerce\Services\OrderService::class);
        $paymentService = new \Ecommerce\Services\MockPaymentService();

        $cartService->addToCart($user->id, $product, 1);
        $cart = $cartService->getUserCart($user->id);

        $order = $orderService->createOrderFromCart($cart);

        // شبیه‌سازی شکست پرداخت
        $result = $paymentService->verify($order, false);

        $this->assertFalse($result);
        $this->assertEquals('failed', $order->fresh()->status);
    }
}
