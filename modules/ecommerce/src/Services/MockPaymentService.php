<?php

namespace Ecommerce\Services;

use Ecommerce\Models\Order;

class MockPaymentService
{
    public function pay(Order $order): string
    {
        // شبیه‌سازی هدایت به درگاه
        return "Redirecting to fake payment gateway for order #{$order->id}";
    }

    public function verify(Order $order, bool $success = true): bool
    {
        if ($success) {
            $order->update(['status' => 'paid']);
            return true;
        }

        $order->update(['status' => 'failed']);
        return false;
    }
}
