<?php

namespace App\Http\Controllers;


use App\Models\Item;
use App\Repositories\CartRepository as CartRepo;
use App\Models\Auth;
use App\Models\Cart;

class CartController extends Controller
{

    protected $carter;

    public function __construct(CartRepo $carter)
    {
        $this->carter = $carter;
        if (!Auth::check()) {
            return redirect('auth/login');
        }
    }

    public function create($itemId, $quantity)
    {
        // dd($_SESSION);
        $item = Item::find($itemId);

        if (!$item) {
            return json_encode(['error' => 'Unable to add to cart']);
        }
        $item->quantity = $quantity;
        $cart = $this->carter->create($item);

        if ($cart) {
            return json_encode(['success' => $item->item_name . ' added to cart']);
        }

        return json_encode(['error' => 'We couldnt create a cart for you']);
    }

    public function checkout()
    {
        $cartitems = Cart::retrieve();
        return renderView('orders.checkout', compact('cartitems'));
    }
}