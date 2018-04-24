<?php

namespace App\Http\Controllers;

use App\Repositories\ItemRepository as ItRep;

use PDC\Request;
use App\Validators\Validator;
use App\Services\Session;
use App\Models\Item;
use App\Models\Auth;

class ItemController extends Controller
{
    /**
     * ItemRepository Instance
     *
     * @var App\Repositories\itemRepository
     */
    protected $it;

    public function __construct(ItRep $it)
    {
        $this->it = $it;
        if (!Auth::check()) {
            return redirect('auth/login');
        }
    }

    public function getAllItems()
    {
        $items = $this->it->getAll();

        return renderView('items.index', compact('items'));
    }

    public function getItem($id)
    {
        $itemm = $this->it->get($id);

        if (!empty($itemm->toArray())) {
            // dd($itemm);
            return renderView('items.show', compact('itemm'));
        }

        return "Item not found!";
    }

    public function getCreate()
    {
        return renderView('items.create');
    }

    public function getEdit($id)
    {
        $item = Item::find($id);
        return renderView('items.edit', compact('item'));
    }

    public function createNewItem(Request $pdcRequest)
    {
        $item = $this->it->create($pdcRequest->request->all());

        if (arraY_key_exists('error', $item->toArray())) {
            Session::error($item->get('error'));
            // dd($item->get('error'));
            return redirect('items/create');
        }

        $itemId = $item->get('id');
        Session::success('New Item Created.');

        return redirect("items");
    }

    public function updateItem(Request $pdcRequest)
    {
        $item = $this->it->update($pdcRequest->request->all());

        if (arraY_key_exists('error', $item->toArray())) {
            Session::error("Unable to update Item. Please Try again");
            return redirect("items/$pdcRequest->i_id");
        }

        $itemId = $item->get('id');

        return redirect("items/$itemId");
    }

    public function deleteItem($id)
    {

    }
}