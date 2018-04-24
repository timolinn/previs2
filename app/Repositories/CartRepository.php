<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use App\Models\Cart;
use App\Models\Auth;
use App\Models\Item;

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
        $cartId = md5(Auth::id());

        $cart = $this->cart->make($cartId, $item);

        if ($cart) {
            return $this->parse($cart);
        }

        return new Collection(['error' => 'Something went wrong.']);

    }

    public function delete($id): bool
    {

    }

    public function update(array $data): Collection
    {

    }

}