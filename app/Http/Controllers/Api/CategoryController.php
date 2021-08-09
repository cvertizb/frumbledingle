<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('parent_category_id'))
        {
            if($request['parent_category_id'] == "null")
                return response()->json(Category::whereNull('parent_id')->get());
            else
                return response()->json(Category::where('parent_id', $request['parent_category_id'])->get());
        }
        return response()->json(Category::with('parent')->get());
    }

    public function store(Request $request)
    {
        Category::create([
            'parent_id'   => $request->input('parent_id'),
            'name'          => $request->input('name'),
        ]);
    }
    public function destroy(Category $category)
    {
        $category->delete();
    }
}
