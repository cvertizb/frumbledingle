<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $data = Item::join('locations', 'locations.id', '=', 'items.location_id')
                        ->join('categories as c', 'c.id', '=', 'items.category_id')
                        ->leftjoin('categories as p', 'p.id', '=', 'c.parent_id')
                        ->select('items.id', 'items.name', 'locations.name as location', 'p.name as parent_category', 'c.name as category', 'items.price')->get();
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        Item::create([
            'name'          => $request->input('name'),
            'category_id'   => $request->input('category'),
            'location_id'   => $request->input('location'),
            'price'         => $request->input('price'),
        ]);
    }

    public function destroy(Item $item)
    {
        $item->delete();
    }
}
