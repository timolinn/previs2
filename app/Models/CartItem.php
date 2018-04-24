<?php

namespace App\Models;

class CartItem
{
    protected $item;

    public $id;
    public $name;
    public $price;
    public $quantity;
    public $image;

    public function __construct(Item $item)
    {
        $this->id = $item->id;
        $this->name = $item->item_name;
        $this->price = $item->item_price;
        $this->quantity = $item->quantity;
        $this->image = $item->image_path;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $this->quantity
        ];
    }

    public function __invoke()
    {
        return $this->toArray();
    }
}