<?php

namespace Ecommerce\Http\Controllers;

use Ecommerce\Http\Requests\PaymentRequest;
use Ecommerce\Services\PaymentService;
use Ecommerce\Models\Order;
use Illuminate\Http\Request;

class PaymentController
{
    /**
     * شروع فرآیند پرداخت
     */
    public function pay(PaymentRequest $request, PaymentService $paymentService)
    {
        $order = Order::findOrFail($request->order_id);

        // اجرای پرداخت
        $paymentResult = $paymentService->pay($order, $request->method);

        return response()->json([
            'order_id' => $order->id,
            'status'   => $paymentResult ? 'processing' : 'failed',
            'message'  => $paymentResult ? 'Payment initiated' : 'Payment failed',
        ]);
    }

    /**
     * تایید پرداخت (callback از درگاه)
     */
    public function verify(PaymentRequest $request, PaymentService $paymentService)
    {
        $order = Order::findOrFail($request->order_id);

        // بررسی نتیجه پرداخت
        $verified = $paymentService->verify($order, $request->token);

        if ($verified) {
            $order->update(['status' => 'paid']);
        } else {
            $order->update(['status' => 'failed']);
        }

        return response()->json([
            'order_id' => $order->id,
            'status'   => $order->status,
            'message'  => $verified ? 'Payment successful' : 'Payment failed',
        ]);
    }

}
