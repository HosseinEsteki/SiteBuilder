<?php

namespace Ecommerce\Http\Controllers;

use Ecommerce\Http\Requests\PaymentRequest;
use Ecommerce\Models\Order;
use Ecommerce\Services\PaymentService;

class PaymentController
{
    public function pay(PaymentRequest $request, PaymentService $paymentService)
    {
        $order = Order::findOrFail($request->order_id);
        $paymentResult = $paymentService->pay($order, $request->method);
        $order = $order->fresh();

        return response()->json([
            'order_id' => $order->id,
            'payment_ref' => $order->payment_ref,
            'authority_key' => $paymentResult->authorityKey,
            'redirect_url' => $paymentResult->redirectResponseUrl,
            'status' => $order->status,
            'message' => 'Payment initiated',
        ]);
    }

    public function verify(PaymentRequest $request, PaymentService $paymentService)
    {
        $order = Order::findOrFail($request->order_id);
        $verification = $paymentService->verify(
            $order,
            $request->authority_key ?: $request->payment_code,
            $request->payment_code,
        );

        return response()->json([
            'order_id' => $order->id,
            'status' => $order->fresh()->status,
            'payment' => $verification->toArray(),
            'message' => $verification->isSuccess() ? 'Payment successful' : 'Payment failed',
        ]);
    }
}
