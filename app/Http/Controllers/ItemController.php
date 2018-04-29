<?php

namespace Previs\Http\Controllers;

use Previs\Repositories\ItemRepository as ItRep;

use Illuminate\Http\Request;
use Previs\Models\Item;

class ItemController extends Controller
{
    /**
     * ItemRepository Instance
     *
     * @var Previs\Repositories\itemRepository
     */
    protected $it;

    public function __construct(ItRep $it)
    {
        $this->it = $it;
       $this->middleware('auth');
    }

    public function getAllItems()
    {
        $items = $this->it->getAll();

        return view('items.index', compact('items'));
    }

    public function getItem($id)
    {
        $itemm = $this->it->get($id);

        if (!empty($itemm->toArray())) {
            // dd($itemm);
            return view('items.show', compact('itemm'));
        }

        return "Item not found!";
    }

    public function getCreate()
    {
        return view('items.create');
    }

    public function getEdit($id)
    {
        $item = Item::find($id);
        return view('items.edit', compact('item'));
    }

    public function createNewItem(Request $request)
    {
        $item = $this->it->create($request->all());

        if (arraY_key_exists('error', $item->toArray())) {

            // dd($item->get('error'));
            return redirect('items/create')->with('error', $item->get('error'));
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image')->store('public/item_images');
            $item = Item::find($item->get('id'));

            $item->update();
        }

        return redirect("items")->with('success', 'New Item Created.');
    }

    public function updateItem(Request $request)
    {
        $item = $this->it->update($request->all());

        if (array_key_exists('error', $item->toArray())) {

            return redirect("items/$request->i_id")->with('error', "Unable to update Item. Please Try again");
        }

        $itemId = $item->get('id');

        if ($request->hasFile('image')) {
            $file = $request->file('image')->store('public/item_images');
            $item = Item::find($itemId);

            $item->update();
        }

        return redirect("items/$itemId")->with('success', 'The Item has been updated');
    }

    public function deleteItem($id)
    {

    }
}