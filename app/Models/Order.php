<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'cart_id',
        'isActive',
        'delivered'
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }
}