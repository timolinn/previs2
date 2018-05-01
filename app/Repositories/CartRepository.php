<?php

namespace Previs\Repositories;

use Illuminate\Support\Collection;
use Previs\Models\Cart;
use Previs\Models\Auth;
use Previs\Models\Item;

class CartRepository extends Repository
{

    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function getAll(): Collection
    {
        return $this->cart->all();

        // return $this->parse($carts);
    }

    public function get($id): Collection
    {

    }

    public function create(Item $item): Collection
    {
        // $cartId = md5(Auth::id());

        $cart = $this->cart->make($item);

        if ($cart) {
            return $this->parse($cart->toArray());
        }

        return new Collection(['error' => 'Something went wrong.']);

    }

    public function delete($id): bool
    {
        return $this->cart->remove($id);
    }

    public function update(array $data): Collection
    {

    }

}