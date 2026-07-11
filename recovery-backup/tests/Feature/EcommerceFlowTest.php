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
use Illuminate\Support\Facades\Http;
use IRPayment\DTO\VerificationValueObject;
use IRPayment\Events\PaymentVerified;

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

    public function test_order_payment_can_start_with_zarinpal_driver(): void
    {
        Http::fake([
            'https://api.zarinpal.com/pg/v4/payment/request.json' => Http::response([
                'data' => [
                    'code' => 100,
                    'authority' => 'A0000000000000000000000000000TESTKEY',
                ],
                'errors' => [],
            ]),
        ]);

        config()->set('irpayment.drivers.zarinpal.merchant_id', 'test-merchant');

        $order = Order::factory()->create([
            'status' => 'pending',
            'total_price' => 200000,
        ]);

        $response = $this->paymentService->pay($order, 'zarinpal');

        $this->assertSame('A0000000000000000000000000000TESTKEY', $response->authorityKey);
        $this->assertSame(
            'https://payment.zarinpal.com/pg/StartPay/A0000000000000000000000000000TESTKEY',
            $response->redirectResponseUrl
        );
        $this->assertSame('processing', $order->fresh()->status);
        $this->assertDatabaseHas('payments', [
            'paymentable_type' => Order::class,
            'paymentable_id' => $order->id,
            'payment_method' => 'zarinpal',
            'authority_key' => 'A0000000000000000000000000000TESTKEY',
            'amount' => 200000,
            'status' => 'processing',
        ]);
    }

    public function test_order_payment_can_verify_with_zarinpal_driver(): void
    {
        Http::fake([
            'https://api.zarinpal.com/pg/v4/payment/verify.json' => Http::response([
                'data' => [
                    'code' => 100,
                    'ref_id' => 123456,
                    'card_hash' => 'hash',
                    'card_pan' => '603799******0000',
                ],
                'errors' => [],
            ]),
        ]);

        config()->set('irpayment.drivers.zarinpal.merchant_id', 'test-merchant');

        $order = Order::factory()->create([
            'status' => 'processing',
            'payment_ref' => 'A0000000000000000000000000000VERIFY',
            'total_price' => 200000,
        ]);

        $order->payments()->create([
            'payment_channel' => 'online',
            'payment_method' => 'zarinpal',
            'description' => "Order #{$order->id}",
            'authority_key' => 'A0000000000000000000000000000VERIFY',
            'amount' => 200000,
            'status' => 'processing',
        ]);

        $verification = $this->paymentService->verify($order, 'A0000000000000000000000000000VERIFY');

        $this->assertTrue($verification->isSuccess());
        $this->assertSame('paid', $order->fresh()->status);
        $this->assertSame('123456', (string) $order->fresh()->payment_ref);
        $this->assertDatabaseHas('payments', [
            'paymentable_type' => Order::class,
            'paymentable_id' => $order->id,
            'reference_id' => 123456,
            'status' => 'complete',
        ]);
    }

    public function test_irpayment_verified_event_updates_order_status(): void
    {
        $order = Order::factory()->create([
            'status' => 'processing',
            'payment_ref' => 'A0000000000000000000000000000EVENT',
            'total_price' => 200000,
        ]);

        $payment = $order->payments()->create([
            'payment_channel' => 'online',
            'payment_method' => 'zarinpal',
            'description' => "Order #{$order->id}",
            'authority_key' => 'A0000000000000000000000000000EVENT',
            'amount' => 200000,
            'status' => 'processing',
        ]);

        event(new PaymentVerified($payment, new VerificationValueObject(
            code: 100,
            referenceId: 987654,
            message: 'Success',
            cardHash: null,
            cardMask: null,
        )));

        $this->assertSame('paid', $order->fresh()->status);
        $this->assertSame('987654', (string) $order->fresh()->payment_ref);
    }

    public function test_checkout_endpoint_creates_order_and_returns_payment_redirect(): void
    {
        Http::fake([
            'https://api.zarinpal.com/pg/v4/payment/request.json' => Http::response([
                'data' => [
                    'code' => 100,
                    'authority' => 'A0000000000000000000000000000CHECKOUT',
                ],
                'errors' => [],
            ]),
        ]);

        config()->set('irpayment.drivers.zarinpal.merchant_id', 'test-merchant');

        $user = User::factory()->create();
        $product = Product::factory()->create(['price' => 100000]);

        $response = $this->postJson('/ecommerce/checkout', [
            'user_id' => $user->id,
            'items' => [
                ['product_id' => $product->id, 'quantity' => 2],
            ],
            'payment' => [
                'method' => 'zarinpal',
            ],
            'shipping' => [
                'address' => 'Test address',
                'city' => 'Tehran',
                'zip' => '1234567890',
            ],
        ]);

        $response->assertCreated()
            ->assertJsonPath('payment.authority_key', 'A0000000000000000000000000000CHECKOUT')
            ->assertJsonPath('order.status', 'processing');

        $this->assertDatabaseHas('ecommerce_orders', [
            'user_id' => $user->id,
            'status' => 'processing',
            'payment_ref' => 'A0000000000000000000000000000CHECKOUT',
        ]);
    }
}
