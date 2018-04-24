<?php

namespace App\Http\Controllers;

use App\Repositories\OrderRepository as OrdRep;

use App\Services\Session;
use App\Services\Notifier;
use PDC\Request;
use App\Models\Auth;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    /**
     * ItemRepository Instance
     *
     * @var \App\Repositories\OrderRepository
     */
    protected $ord;

    public function __construct(OrdRep $ord)
    {
        $this->ord = $ord;

        if (!Auth::check()) {
            return redirect('auth/login');
        }

        if (!Auth::user()->isAdmin()) {
            return redirect('items');
        }
    }

    public function deliver($id)
    {
        $order = $this->ord->markDelivered($id);

        if ($order) {
            $order = Order::find($id);
            // dd($order->user_id);
            $user = User::find($order->user_id);

            Session::flash('success', "Order status updated");
            $res = Notifier::orderReadyNotification($user, $order);
            return redirect('orders');
        }
        Session::flash('error', "Error status not updated");
        return redirect('orders');
    }

    public function getAllOrders()
    {
        $orders = $this->ord->getAll();
        // dd($orders);

        return renderView('orders.index', compact('orders'));
    }

    public function getOrder($id)
    {
        $order = $this->ord->get($id);

        if (!empty($order->toArray())) {
            return $order;
        }

        return "Order not found!";
    }

    public function getCreate()
    {
        return renderView('orders.create');
    }

    public function getEdit()
    {
        return renderView('orders.edit');
    }

    public function createNewOrder(Request $pdcRequest)
    {
        // dd($pdcRequest->request->all());
        $order = $this->ord->create($pdcRequest->request->all());

        if (arraY_key_exists('error', $order->toArray())) {
            Session::error($order->get('error'));
            // dd($order->get('error'));
            return redirect('orders/create');
        }

        Session::success("Your order was successful. We'll notify you when it's ready.");
        Notifier::notifyAdmin(Auth::user(), Order::find($order->get('id')));


        return redirect('items');
    }

    public function updateOrder(Request $pdcRequest)
    {
        if (!Auth::user()->isAdmin()) {
            Session::error("You're not allowed to perform this action. What the heck? I'm messaging the admin!");
            return redirect('dashboard');
        }

        $order = $this->ord->update($pdcRequest->request->all());

        if (arraY_key_exists('error', $order->toArray())) {
            Session::error($order->get('error'));
            // dd($order->get('error'));
            return redirect('orders/create');
        }

        Session::success("Update successful");
        return redirect('orders');
    }

    public function deleteOrder($id)
    {

    }
}