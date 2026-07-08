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
        $order = Order::with('user', 'items.product')->first();

        if (! $order || ! $order->user?->email) {
            return response()->json([
                'message' => 'No order with a user email is available for test email.',
            ], 404);
        }

        Mail::to($order->user->email)->send(new OrderCreatedMail($order));

        return response()->json(['message' => 'Test email sent.']);
    }
}
