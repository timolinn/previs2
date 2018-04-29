<?php

namespace Previs\Http\Controllers;


use Previs\Services\Session;
use Previs\Models\Auth;
use Previs\Models\User;
use Previs\Services\Notifier;

class AdminController extends Controller
{

    public function __construct()
    {
        if (!Auth::check()) {
            return redirect('auth/login');
        }
    }

    public function sendOrderReadyNotif($userId, $orderId)
    {
        if (!Auth::user()->isAdmin()) {
            Session::flash('error', 'You are not allowed to do this.');

            return redirect('dashboard');
        }

        $user = User::find($userId);
        if ($user) {
            Notifier::notify($user, 'order_ready');
        }
        return "Done";
    }

    public function send()
    {
        // dd('Here');
        $user = User::find(2);
        $mail = Notifier::notifyAdmin($user);
        dd($mail);
    }

}