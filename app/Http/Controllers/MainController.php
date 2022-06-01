<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MainController extends Controller
{
    public function index()
    {
        // return view('welcome')->whit([
        //     'products'=>Product::all(),
        // ]);
        $products =Product::available()->get();

        return view('welcome')->with([
            'products'=> $products,
        ]);
    }
}
