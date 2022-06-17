@extends('Layouts.app')
@section('content')
	<h1>Payment Deteils</h1>
	<h4 class="text-center"><strong>Grand Total: </strong>{{ $order->total }}</h4>
	<div class="text-center mb-3">
	    <form 
            method="POST" 
            action="{{ route('orders.payments.store', ['order' => $order->id]) }}" 
            class="d-inline"
        >
            @csrf
            <button type="submit" class="btn btn-success">Pay</button>
        </form>
	</div>
@endsection