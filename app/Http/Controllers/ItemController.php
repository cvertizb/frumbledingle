<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class ItemController extends Controller
{
    public function index()
    {
        return view('items');
    }
}
