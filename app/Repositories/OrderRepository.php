<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Auth;
use App\Services\Session;

class OrderRepository extends Repository implements RepositoryInterface
{
    /**
     * Instance of the Order class
     *
     * @var App\Models\Order
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

            $cart = new Cart;
            $cart->user_id = Auth::id();
            $cart->cart = json_encode($cart::retrieve());
            $cart->save();


            $this->order->user_id = Auth::id();
            $this->order->cart_id = $cart->id;
            // $this->order->eta = $data['eta'];

            $this->order->save();
            Session::set(md5(Auth::id()), null);

            return $this->parse($this->order->toArray());

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
