<?php

namespace Previs\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $userfullname;

    protected $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $order)
    {
        $this->userfullname = $username;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $orderItems = $this->order->get('cart')->content;
        $orderItems = json_decode($orderItems, true);

        return $this->view('emails.orders.new')
                    ->with([
                        'orderItems' => $orderItems['cart'],
            ]);
    }
}
