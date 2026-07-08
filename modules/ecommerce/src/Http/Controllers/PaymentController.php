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
            'status' => $order->status,
            'message' => $paymentResult ? 'Payment initiated' : 'Payment failed',
        ]);
    }

    public function verify(PaymentRequest $request, PaymentService $paymentService)
    {
        $order = Order::findOrFail($request->order_id);
        $verified = $paymentService->verify($order, $request->token);

        $order->update(['status' => $verified ? 'paid' : 'failed']);

        return response()->json([
            'order_id' => $order->id,
            'status' => $order->fresh()->status,
            'message' => $verified ? 'Payment successful' : 'Payment failed',
        ]);
    }
}
