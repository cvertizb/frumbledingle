<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('parent_category_id'))
        {
            if($request['parent_category_id'] == -1)
                return response()->json(Category::whereNull('parent_id')->get(), 200);
            else
                return response()->json(Category::where('parent_id', $request['parent_category_id'])->get(), 200);
        }
        return response()->json(Category::with('parent')->get(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'parent_id' => 'required',
            'name' => 'required|max:255',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $category = Category::create([
            'parent_id'   => ($request->input('parent_id') == -1) ? null : $request->input('parent_id'),
            'name'          => $request->input('name'),
        ]);

        return response()->json(['status' => 'success', 'message' => 'Category (#'.$category->id.') successfully created'], 200);
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['status' => 'success', 'message' => 'Category (#'.$category->id.') successfully deleted'], 200);
    }
}
