<?php

namespace Previs\Http\Controllers;

use Previs\Models\User;
use Previs\Models\Item;
use Previs\Models\Order;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {

        $totalUsers = User::all()->count();
        $totalItems = Item::all()->count();
        $totalOrders = Order::all()->count();
        return view('admin.dashboard', compact('totalUsers', 'totalItems', 'totalOrders'));
    }


    public function deliver($id)
    {
        $order = $this->ord->markDelivered($id);

        if ($order) {
            $order = Order::find($id);
            // dd($order->user_id);
            $user = User::find($order->user_id);


            $res = Notifier::orderReadyNotification($user, $order);
            return redirect('orders')->with('success', "Order status updated");;
        }

        return redirect('orders')->with('error', "Error status not updated");
    }

    public function getAllOrders()
    {
        $orders = $this->ord->getAll();
        // dd($orders);

        return view('orders.index', compact('orders'));
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
        return view('orders.create');
    }

    public function getEdit()
    {
        return view('orders.edit');
    }
}