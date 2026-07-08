<?php

namespace Ecommerce\Services;

use Ecommerce\Models\Order;

class PaymentService
{
    public function pay(Order $order, string $method): bool
    {
        return match ($method) {
            'zarinpal', 'stripe', 'paypal' => $this->fakeGateway($order, $method),
            default => false,
        };
    }

    public function verify(Order $order, string $token): bool
    {
        return $token === $order->payment_ref;
    }

    protected function fakeGateway(Order $order, string $method): bool
    {
        $order->update([
            'payment_ref' => $order->payment_ref ?: "{$method}-{$order->id}",
            'status' => 'processing',
        ]);

        return true;
    }
}
