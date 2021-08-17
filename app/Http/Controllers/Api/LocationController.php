<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Validator;

class LocationController extends Controller
{
    public function index()
    {
        return response()->json(Location::get(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $location = Location::create(['name' => $request->input('name')]);

        return response()->json(['status' => 'success', 'message' => 'Location (#'.$location->id.') successfully created'], 200);
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return response()->json(['status' => 'success', 'message' => 'Location (#'.$location->id.') successfully deleted'], 200);
    }
}