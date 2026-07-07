<?php

namespace Ecommerce\Services;

use Shetabit\Payment\Facade\Payment;
use Ecommerce\Models\Order;

class PaymentService
{
    /**
     * شروع پرداخت
     *
     * @param Order $order
     * @param string $method
     * @return bool
     */
    public function pay(Order $order, string $method): bool
    {
        // اینجا می‌تونی اتصال واقعی به درگاه رو پیاده‌سازی کنی
        // برای تست، فقط true برمی‌گردونیم
        switch ($method) {
            case 'zarinpal':
                // اتصال به زرین‌پال
                return $this->fakeGateway($order);
            case 'stripe':
                // اتصال به Stripe
                return $this->fakeGateway($order);
            case 'paypal':
                // اتصال به PayPal
                return $this->fakeGateway($order);
            default:
                return false;
        }
    }

    /**
     * تایید پرداخت
     *
     * @param Order $order
     * @param string $token
     * @return bool
     */
    public function verify(Order $order, string $token): bool
    {
        // در حالت واقعی باید توکن رو با درگاه بررسی کنی
        // اینجا فقط شبیه‌سازی می‌کنیم
        return $token === $order->payment_ref;
    }

    /**
     * شبیه‌سازی درگاه پرداخت
     */
    protected function fakeGateway(Order $order): bool
    {
        // فرض می‌کنیم همیشه موفقه
        return true;
    }

}
