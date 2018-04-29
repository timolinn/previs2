<?php

namespace Previs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Cart as CartManager;
use Gloudemans\Shoppingcart\CartItem;

class Cart extends Model implements \JsonSerializable
{
    protected $fillable = [
        'user_id',
        'cart',
    ];

    protected $table = 'shoppingcarts';

    public $items = [];

    protected $casts = [
        'cart' => 'array',
        'created_at' => 'date'
    ];

    private $cartMan;

    public function __construct(CartManager $cartMan)
    {
        parent::__construct();

        $this->cartMan = $cartMan;
    }

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
        return CartManager::remove($rowId);
    }

    public function find($itemId)
    {
        foreach(CartManager::content() as $index => $val) {
            if ($val->id == $itemId) {
                return $index;
            }
        }
    }

    public function clearAll()
    {
        return CartManager::destroy();
    }

    public function toCollection()
    {
        return new Collection($this->items);
    }

    // public function toJson()
    // {
    //     return json_encode([
    //         'owner' => $this->user_id,
    //         'cart' => $this->cart,
    //         'created_on' => $this->created_at
    //     ]);
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}