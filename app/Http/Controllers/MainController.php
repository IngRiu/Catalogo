<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MainController extends Controller
{
    public function index()
    {
        // \DB::connection()->enableQueryLog();
        // return view('welcome')->whit([
        //     'products'=>Product::all(),
        // ]);
        // $products =Product::available()->get();
        $products =Product::all();
        // $products =Product::with('images');

        return view('welcome')->with([
            'products'=> $products,
        ]);
    }
}
