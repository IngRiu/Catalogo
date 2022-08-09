<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
        $this->middleware('auth');//->only('store');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cart = $this->cartService->getFromCookie();
        // dd($cart);
        if (!isset($cart)||$cart->products->isEmpty()) {
            return redirect()
                ->back()
                ->withErrors("Your car is empty!");
        }

        return view('orders.create')->with([
            'cart' => $cart,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        return DB::transaction(function() use ($request){
            $user = $request->user();
            // dd($user);
            $order = $user->orders()->create([
                'status' => 'pending',
            ]);
            $cart = $this->cartService->getFromCookie();

            $cartProductsWithQuantity = $cart
                ->products
                ->mapWithKeys(function($product){
                    $quantity = $product->pivot->quantity;

                    if($product->Stock < $quantity)
                    {
                        throw ValidationException::withMessages([
                            'product'=> "There is not enough stock for the quantity you required of {$product->Title}"
                        ]);            
                    }

                    $product->decrement('Stock', $quantity);
                    $element[$product->id]=['quantity' => $quantity];
                    return $element;
                });

            //dd($cartProductsWithQuantity);

            $order->products()->attach($cartProductsWithQuantity->toArray());

            return redirect()->route('orders.payments.create', ['order' => $order]);
        });

    }
}
