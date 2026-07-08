<?php

namespace Ecommerce\Services;

use Ecommerce\Enums\OrderStatus;
use Ecommerce\Models\Order;
use IRPayment\DTO\ProcessResponseValueObject;
use IRPayment\DTO\VerificationValueObject;
use IRPayment\Enums\PaymentStatus;
use IRPayment\Facades\IRPayment;
use IRPayment\Models\Payment;

class PaymentService
{
    public function pay(Order $order, string $method): ProcessResponseValueObject
    {
        $payment = $this->createPayment($order, $method);
        $response = IRPayment::driver($method)->process($payment);

        $payment->update([
            'authority_key' => $response->authorityKey,
            'status' => PaymentStatus::PROCESSING,
        ]);

        $order->update([
            'payment_ref' => $response->authorityKey,
            'status' => OrderStatus::Processing->value,
        ]);

        return $response;
    }

    public function verify(Order $order, string $authorityKey, ?string $paymentCode = null): VerificationValueObject
    {
        $payment = $order->payments()
            ->where('authority_key', $authorityKey)
            ->latest()
            ->firstOrFail();

        $method = (string) $payment->payment_method;
        $credentials = match ($method) {
            'payping' => [
                'client_ref_id' => $payment->id,
                'payment_code' => $paymentCode ?: $authorityKey,
            ],
            default => ['authority_key' => $authorityKey],
        };

        $verification = IRPayment::driver($method)->verify($payment->amount, $credentials);
        $paymentStatus = $verification->isSuccess() ? PaymentStatus::COMPLETE : PaymentStatus::FAILED;

        $payment->update([
            ...$verification->toArray(),
            'status' => $paymentStatus,
        ]);

        $order->update([
            'status' => $verification->isSuccess()
                ? OrderStatus::Paid->value
                : OrderStatus::Failed->value,
            'payment_ref' => $verification->referenceId ?: $authorityKey,
        ]);

        return $verification;
    }

    protected function createPayment(Order $order, string $method): Payment
    {
        return $order->payments()->create([
            'payment_channel' => 'online',
            'payment_method' => $method,
            'description' => "Order #{$order->id}",
            'phone' => $order->shipping_user,
            'amount' => (int) $order->total_price,
            'status' => PaymentStatus::PENDING,
            'metadata' => [
                'order_id' => $order->id,
            ],
        ]);
    }
}
