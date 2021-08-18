<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use App\Models\Item;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $data = Item::join('locations', 'locations.id', 'items.location_id')
                       ->join('categories as c', 'c.id', 'items.category_id')
                       ->leftjoin('categories as p', 'p.id', '=', 'c.parent_id')
                       ->where('items.price', '>=', $request->input('price'))
                       ->select('locations.name as location', 'p.name as parent_category', 'c.name as category', DB::raw('count(items.*) as count'))
                       ->groupBy('locations.name', 'p.name', 'c.name')->get();

        return response()->json($data, 200);
    }
}
