<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Item;
use Validator;

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'category' => 'required|exists:categories,id',
            'location' => 'required|exists:locations,id',
            'price' => 'required|numeric|min:0|not_in:0'
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $item = Item::create([
            'name'          => $request->input('name'),
            'category_id'   => $request->input('category'),
            'location_id'   => $request->input('location'),
            'price'         => $request->input('price'),
        ]);

        return response()->json(['status' => 'success', 'message' => 'Item (#'.$item->id.') successfully created'], 200);
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return response()->json(['status' => 'success', 'message' => 'Item (#'.$item->id.') successfully deleted'], 200);
    }
}
