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

            $this->order->user_id = $userId;
            $this->order->isActive = 1;
            // $this->order->eta = $data['eta'];
            $this->order->save();

            Cart::store($this->order->id, \Auth::user()->user_name); // save the cart too

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
