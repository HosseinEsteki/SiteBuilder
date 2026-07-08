<?php

namespace Email\Mail;

use Ecommerce\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreatedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Order $order
    ) {}

    public function build()
    {
        return $this->subject("Order #{$this->order->id} created")
            ->view('email::emails.order_created')
            ->with([
                'order' => $this->order->loadMissing('items.product', 'user'),
            ]);
    }
}
