<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;

class Notifier
{

    public function notify(User $user)
    {
        echo "Email sent!";
    }

    public function notifyAdmin(User $user, Order $order)
    {
        $message = realpath(__DIR__ . '/../views/emails/new-order.view.php');
        $message = str_replace('%fullname%', $user->first_name . " " . $user->last_name, file_get_contents($message));
        $mail = new Mail("xaviertim017@gmail.com", 'New Order Received.', $message);

        try {
            return $mail->send();

        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    public function orderConfirmation(User $user, Order $order)
    {
        $message = realpath(__DIR__ . '/../views/emails/order-confirmation.view.php');
        $message = str_replace('%fullname%', $user->first_name . " " . $user->last_name, file_get_contents($message));
        $mail = new Mail($user->email, 'Your Order.', $message);

        try {
            return $mail->send();

        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    public function orderReadyNotification(User $user, Order $order)
    {
        $message = realpath(__DIR__ . '/../views/emails/order-ready-notif.view.php');
        $message = str_replace('%fullname%', $user->first_name . " " . $user->last_name, file_get_contents($message));
        $mail = new Mail($user->email, 'Your Order is Ready.', $message);

        try {
            return $mail->send();

        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function welcome($user)
    {
        // dd($user);
        $message = realpath(__DIR__ . '/../views/emails/welcome.view.php');
        $message = str_replace('%fullname%', $user->get('first_name') . " " . $user->get('last_name'), file_get_contents($message));
        $mail = new Mail($user->get('email'), 'Welcome to Previs Discount Club.', $message);

        try {
            return $mail->send();

        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }
}