<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('Products.index')->with([
            'products'=>Product::all(),
        ]);
    }

    public function create()
    {
        // return 'Formulario para crear productos';
        // 
        return view('Products.create');
        // return 'hola';
    }

    public function store(Request $request)
    {
        $rules =[
            'Title' => ['required','max:255'],
            'Description' => ['required', 'max:1000'],
            'Price' => ['required','min:1'],
            'Stock'=>['required', 'min:0'],
            'Status'=>['required','in:available,unavailable'],
        ];
        request()->validate($rules);


        if(request()->Status == 'available' && request()->Stock == 0 )
        {
            // session()->put('error', 'If available must have stock');
            session()->flash('error', 'If available must have stock');
            return redirect()
                ->back()
                ->withInput(request()->all());
        }
        // session()->forget('error');
        // dd(request());
        // 
        $product = Product::create(request()->all());
        // $product = Product::create([
        //     'Title'=>request()->Title,
        //     'Description'=>request()->Description,
        //     'Price'=>request()->Price,
        //     'Stock'=>request()->Stock,
        //     'Staus'=>request()->Staus,
        // ]);
        // return $product;
        // return redirect()->back();
        // return redirect()->action('MainController@index');
        session()->flash('success', "The new product with id $product->id was created");
        return redirect()->route('products.index');
    }

    public function show($product)
    {
        return view('Products.show')->with([
            'product'=>Product::findOrFail($product),
        ]);
        //return "Mostrando el id {$product}";
    }

    public function edit($product)
    {
        // return "Formulario donde se editara el producto {$product}";
        return view('Products.edit')->with([
            'product'=>Product::findOrFail($product),
        ]);
    }

    public function update($product)
    {
        $rules =[
            'Title' => ['required','max:255'],
            'Description' => ['required', 'max:1000'],
            'Price' => ['required','min:1'],
            'Stock'=>['required', 'min:0'],
            'Status'=>['required','in:available,unavailable'],
        ];
        request()->validate($rules);
        // dd(request());
        $product = Product::findOrFail($product);
        $product->update(request()->all());
        // return $product;
        return redirect()->route('products.index');
    }

    public function distroy($product)
    {
        // dd($product);
        $product = Product::findOrFail($product);
        $product->delete();
        // return $product;
        return redirect()->route('products.index');
    }


}
