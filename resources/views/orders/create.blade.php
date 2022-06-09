@extends('Layouts.app')
@section('content')
	<h1>Order Details</h1>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead class="thead-light">
				<tr>
					<th>Produc</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				@foreach($cart->products as $product)
					<tr>
						<td>
							<img src=" {{ asset($product->images->first()->path) }} " width="100">
							{{$product->Title}}
						</td>
						<td>{{$product->Price}}</td>
						<td>{{$product->pivot->quantity}}</td>
						<td>
							<strong>
								{{ $product->pivot->quantity * $product->Price }}
							</strong>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection