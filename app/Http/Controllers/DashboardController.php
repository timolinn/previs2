<?php

namespace Previs\Http\Controllers;

use Previs\Models\User;
use Previs\Models\Item;
use Previs\Models\Order;

class DashboardController extends Controller
{

    public function __construct()
    {
        // $this->middleware(['auth', 'admin']);
    }

    public function index()
    {

        $totalUsers = User::all()->count();
        $totalItems = Item::all()->count();
        $totalOrders = Order::all()->count();
        return view('admin.dashboard', compact('totalUsers', 'totalItems', 'totalOrders'));
    }
}