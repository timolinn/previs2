<?php

namespace Previs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Cart as CartManager; // Gloudemans\Shoppingcart\Cart Facade
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Exceptions\CartAlreadyStoredException;

class Cart extends Model implements \JsonSerializable
{
    protected $fillable = [
        'user_id',
        'content',
    ];

    protected $table = 'shoppingcarts';

    public $items = [];

    protected $casts = [
        'content' => 'array',
        'created_at' => 'date'
    ];

    public function itemExists(Item $item)
    {
        // dd($this->getRowId($item));
        foreach(CartManager::content() as $index => $value) {
            if ($item->id == $value->id) {
                return true;
            }
        }
    }

    public static function retrieve()
    {
        return CartManager::content();
    }

    public static function store($orderId, $username)
    {
        try {

            static::cartDestroy(); // clear cart in session. It won't work if you clear after storing.
            // $cart = CartManager::instance($username)->store($orderId);

            return $cart;

        } catch(CartAlreadyStoredException $e) {
            // dd($e);
            return $e->getMessage();
        } catch(\Exception $e) {
            return $e->getMessage();
        }

    }

    public function totalAmount()
    {
        return CartManager::subTotal();
    }

    public function count()
    {
        return CartManager::count();
    }

    private function getRowId(Item $item)
    {
        $content = CartManager::content();
        $rowId = '';
        $item = $content->filter(function($cartItem) use ($item, &$rowId) {
            if ($cartItem->id == $item->id) {
                $rowId = $cartItem->rowId;
            }
        });
        return $rowId;
    }

    /**
     * Creates new cart if it doesn't exists
     * Updates Cart if it already exists
     *
     * @param Item $item
     * @return CartItem[]
     */
    public function make(Item $item)
    {
        // $this->destroyCart();

        $item = CartManager::add($item, $item->quantity, ['name' => $item->item_name, 'image' => $item->image_path]);

        // dd(CartManager::content());

        return CartManager::content();

    }

    public function persistToDb()
    {
        $this->user_id = Auth::id();
        $this->cart = json_encode(Session::get(md5(Auth::id()))->toArray());

        return $this->save();
    }

    public function remove($rowId)
    {
        CartManager::remove($rowId);

        return true;
    }

    public function find($itemId)
    {
        foreach(CartManager::content() as $index => $val) {
            if ($val->id == $itemId) {
                return $index;
            }
        }
    }

    public function destroyCart()
    {
        return CartManager::destroy();
    }

    public static function cartDestroy()
    {
        return CartManager::destroy();
    }

    public function toCollection()
    {
        return new Collection($this->items);
    }

    public static function getJson()
    {
        $content = static::retrieve();//  returns an Instance of CartManager

        return json_encode([
            'owner' => \Auth::id(),
            'cart' => $content->toArray(),
            'totalAmount' => CartManager::subTotal()
        ]);
    }

    public function toJson($options = 0)
    {
        return json_encode([
            'owner' => $this->user_id,
            'cart' => $this->cart,
            'created_on' => $this->created_at
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}