<?php

namespace Email\Http\Controllers;

use Ecommerce\Models\Order;
use Email\Mail\OrderCreatedMail;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendTest()
    {
        $order = Order::first(); // فقط برای تست
        Mail::to($order->user->email)->send(new OrderCreatedMail($order));

        return response()->json(['message' => 'ایمیل تستی ارسال شد']);
    }
}
