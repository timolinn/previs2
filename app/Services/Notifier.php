<?php

namespace Previs\Services;

use Previs\Models\Order;
use Previs\Models\User;
use Mail;
use Previs\Mail\OrderDetails;
use Previs\Mail\OrderReady;
use Previs\Mail\NewOrder;

class Notifier
{

    public function notify(User $user)
    {
        echo "Email sent!";
    }

    public static function sendOrderDetailsMail(User $user, $order)
    {
        // dd($order);
        try {
            Mail::to($user)->send(new OrderDetails($user, $order));

        } catch(\Exception $e) {
            // dd($e);
            return $e->getMessage();
        }
    }

    public static function notifyAdmin($about, $username = '', $data = null)
    {
        if (strtolower($about) == 'new_order') {
            try {
                Mail::to('fabrobocomx@gmail.com')->send(new NewOrder($username, $data));

            } catch(\Exception $e) {
                // dd($e);
                return $e->getMessage();
            }
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