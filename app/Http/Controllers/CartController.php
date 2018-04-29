<?php

namespace Previs\Http\Controllers;


use Previs\Models\Item;
use Previs\Repositories\CartRepository as CartRepo;
use Previs\Models\Auth;
use Previs\Models\CartItem;
use Previs\Models\Cart;

class CartController extends Controller
{

    protected $carter;

    public function __construct(CartRepo $carter)
    {
        $this->carter = $carter;
    }

    public function addToCart()
    {
        $item = Item::find(1);
        $cart = Cart::add($item, 3);
        // $cart->associate('\Previs\Models\Item');
        dd($cart->model);
    }

    public function getCartContents()
    {
        return Cart::retrieve()->toJson();
    }

    public function create($itemId, $quantity)
    {
        // dd($_SESSION);
        $item = Item::find($itemId);

        if (!$item) {
            return response()->json(['error' => 'Item not found']);
        }
        $item->quantity = $quantity;
        $cart = $this->carter->create($item);

        if (!$cart->isEmpty()) {
            return response()->json(['success' => $item->item_name . ' added to cart', 'content' => $cart->toJson() ]);
        }

        return response()->json(['error' => 'We couldnt create a cart for you']);
    }

    public function checkout()
    {
        $cartitems = Cart::retrieve();
        return view('orders.checkout', compact('cartitems'));
    }
}