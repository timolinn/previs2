<?php

namespace Previs\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Previs\Models\Order;
use Previs\Models\User;
use Cart;

class OrderDetails extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd(($this->order->get('cart')->toArray()));
        $orderItems = $this->order->get('cart')->content;
        $orderItems = json_decode($orderItems, true);
        // dd($orderItems['totalAmount']);
        return $this->view('emails.orders.details')
                    ->with([
                        'orderItems' => $orderItems['cart'],
                        'totalAmount' => $orderItems['totalAmount']
                    ]);
    }
}
