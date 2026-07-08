<?php

namespace Email\Mail;

use Ecommerce\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Order $order
    ) {}

    public function build()
    {
        return $this->subject('Order created')
            ->view('email::emails.order_created');
    }
}
