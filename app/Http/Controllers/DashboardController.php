<?php

namespace App\Http\Controllers;


use App\Models\Auth;
use App\Services\Session;
use App\Models\User;
use App\Models\Item;
use App\Models\Order;

class DashboardController extends Controller
{

    public function __construct()
    {
        if (!Auth::check()) {
            return redirect('auth/login');
        }
    }

    public function index()
    {

        // Session::clear();
        // dd($_SESSION);
        if (Auth::check()) {
            if (!Auth::user()->isAdmin()) {
                return redirect("items");
            }
            $totalUsers = User::all()->count();
            $totalItems = Item::all()->count();
            $totalOrders = Order::all()->count();
            return renderView('admin.dashboard', compact('totalUsers', 'totalItems', 'totalOrders'));
        } else {
            return redirect("auth/login");

        }

    }
}