<?php

namespace Previs\Repositories;

use Previs\Interfaces\RepositoryInterface;
use Illuminate\Support\Collection;
use Previs\Models\Order;
use Previs\Models\Cart;
use Previs\Models\Auth;
use Previs\Services\Session;

class OrderRepository extends Repository implements RepositoryInterface
{
    /**
     * Instance of the Order class
     *
     * @var Previs\Models\Order
     */
    protected $order;

    public function __construct(Order $order)
    {
        $this->order  = $order;
    }

    public function getAll(): Collection
    {
        // dd(Order::with('cart')->get());
        return $this->order->with('cart')->get();
    }

    public function get($id): Collection
    {
        $order = $this->order->find($id);

        if ($order == null) return new Collection;

        return $this->parse($order->toArray());
    }

    public function markDelivered($id)
    {
        $order = $this->order->find($id);

        if ($order == null) return null;

        $order->delivered = 1;

        if ($order->update()) {
            return true;
        }

        return  false;
    }

    public function create(array $data): Collection
    {
        try {

            $userId = \Auth::id();

            $cart = Cart::create([
                'user_id' => $userId,
                'content' => Cart::getJson()
            ]);

            Cart::cartDestroy(); // destroys Cart in session

            $this->order->user_id = $userId;
            $this->order->shoppingcart_id = $cart->id;
            // $this->order->eta = $data['eta'];
            $this->order->save();


            $orderCollection = $this->parse($this->order->toArray());
            $orderCollection->put('cart', $cart);

            return $orderCollection;

        } catch(\Exception $e) {
            return new Collection(['error' => $e->getMessage() ]);
        }

    }

    public function update(array $data): Collection
    {

    }

    public function delete($id): bool
    {

    }
}
