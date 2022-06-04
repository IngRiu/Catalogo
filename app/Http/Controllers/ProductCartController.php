<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductCartController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        // dd($product);
        $cart = Cart::Create();

        $quantity = $cart->products()
            ->find($product->id)
            ->pivot
            ->quantity ?? 0;

        $cart->products()->attach([
            $product->id => ['quantity' => $quantity + 1],
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Cart $cart)
    {
        //
    }
}
