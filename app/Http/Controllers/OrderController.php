<?php

namespace Previs\Http\Controllers;

use Previs\Repositories\OrderRepository as OrdRep;

use Previs\Services\Notifier;
use Illuminate\Http\Request;
use Previs\Models\Cart;
use Previs\Models\Order;
use Previs\Models\User;

class OrderController extends Controller
{
    /**
     * ItemRepository Instance
     *
     * @var \Previs\Repositories\OrderRepository
     */
    protected $ord;

    public function __construct(OrdRep $ord)
    {
        $this->ord = $ord;

        $this->middleware(['auth']);
    }

    public function createNewOrder(Request $request)
    {
        // dd($request->all());
        $order = $this->ord->create($request->all());

        if (arraY_key_exists('error', $order->toArray())) {
            return redirect(route('review-order'))->with('error', $order->get('error'));
        }

        // Notifier::notifyAdmin(Auth::user(), Order::find($order->get('id')));
        return redirect(route('home'))->with('success', "Your order was successful. We'll notify you when it's ready. Thanks for shopping at PREVIS");
    }

    public function updateOrder(Request $request)
    {
        if (!Auth::user()->isAdmin()) {

            return redirect('dashboard')->with('error', "You're not allowed to perform this action. What the heck? I'm messaging the admin!");
        }

        $order = $this->ord->update($request->all());

        if (arraY_key_exists('error', $order->toArray())) {
            return redirect('orders/create')->with('error', $order->get('error'));
        }

        return redirect('orders')->with('success', 'Update Successful');
    }

    public function reviewOrder()
    {
        if (!\Auth::check()) {
            return redirect(route('login'))->with('You must be logged in to review your order');
        }

        $cart = new Cart;
        $cartItems = $cart::retrieve();
        $totalAmount = $cart->totalAmount();
        return view('orders.review', compact('cartItems', 'totalAmount'));
    }

    public function deleteOrder($id)
    {

    }
}