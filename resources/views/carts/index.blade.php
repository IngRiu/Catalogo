@extends('Layouts.app')
@section('content')
    <h1>Your cart</h1>
    @if(!isset($cart) || $cart->products->isEmpty())
        <div class="alert alert-warning">
            Your cat is  empty.
        </div>
    @else
        <div class="row">
            @foreach($cart->products as $product)
                <div class="col-3">
                    @include('components.product-card')
                </div>
            @endforeach
            
        </div>
    @endempty
@endsection