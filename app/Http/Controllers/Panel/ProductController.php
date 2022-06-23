<?php

namespace App\Http\Controllers\Panel;

// use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Scopes\AvailableScope;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');//->except(['index','create']);
    // }

    public function index()
    {
        return view('Products.index')->with([
            'products' => Product::withoutGlobalScope(AvailableScope::class)->get(),
            // 'products'=>Product::all(),
        ]);
    }

    public function create()
    {
        // return 'Formulario para crear productos';
        //
        return view('Products.create');
        // return 'hola';
    }

    public function store(ProductRequest $request)
    {
        // dd($request);
        // $rules =[
        //     'Title' => ['required','max:255'],
        //     'Description' => ['required', 'max:1000'],
        //     'Price' => ['required','min:1'],
        //     'Stock'=>['required', 'min:0'],
        //     'Status'=>['required','in:available,unavailable'],
        // ];
        // request()->validate($rules);


        // if($request->Status == 'available' && $request->Stock == 0 )
        // {
        //     // session()->put('error', 'If available must have stock');
        //     // session()->flash('error', 'If available must have stock');
        //     return redirect()
        //         ->back()
        //         ->withInput($request->all())
        //         ->withErrors('If available must have stock');
        // }
        // dd(request()->all(), $request->all(), $request->validated());
        // session()->forget('error');
        // dd(request());
        //
        $product = Product::create($request->validated());
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
        // session()->flash('success', "The new product with id $product->id was created");
        return redirect()->route('products.index')
        ->withSuccess("The new product with id $product->id was created");
        // ->with(['Success' => 'XXXXXX']);
    }

    public function show(Product $product)
    {
        return view('Products.show')->with([
            'product'=> $product,
        ]);
        // return view('Products.show')->with([
        //     'product'=>Product::findOrFail($product),
        // ]);
        //return "Mostrando el id {$product}";
    }

    public function edit(Product $product)
    {
        // return "Formulario donde se editara el producto {$product}";
        return view('Products.edit')->with([
            'product'=> $product, //Product::findOrFail($product),
        ]);
    }

    public function update(ProductRequest $request,Product $product)
    {
        // $rules =[
        //     'Title' => ['required','max:255'],
        //     'Description' => ['required', 'max:1000'],
        //     'Price' => ['required','min:1'],
        //     'Stock'=>['required', 'min:0'],
        //     'Status'=>['required','in:available,unavailable'],
        // ];
        // request()->validate($rules);
        // dd(request());
        // $product = Product::findOrFail($product);
        $product->update($request->validated());
        // return $product;
        return redirect()
            ->route('products.index')
            ->withSuccess("The product with id $product->id was edited");
    }

    public function destroy(Product $product)
    {
        // dd($product);
        // $product = Product::findOrFail($product);
        $product->delete();
        // return $product;
        return redirect()->route('products.index')
        ->withSuccess("The product with id $product->id was deleted");
    }


}
