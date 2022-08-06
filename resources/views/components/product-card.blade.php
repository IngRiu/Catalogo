<div class="card">
	<div id="carousel{{ $product->id }}" class="carousel slide carousel-fade">
		<div class="carousel-inner">
			@foreach($product->images as $image)
				<div class="carousel-item {{ $loop->first ? 'active' : '' }}">
					<img class="d-block w-100 card-img-top" src="{{ asset($image->path) }}" height="500">
				</div>
			@endforeach
		</div>
		<a class="carousel-control-prev" href="#carousel{{ $product->id }}" role="button" data-bs-slide="prev">
			<span class="carousel-control-prev-icon"></span>
		</a>
		<a class="carousel-control-next" href="#carousel{{ $product->id }}" role="button" data-bs-slide="next">
			<span class="carousel-control-next-icon"></span>
		</a>
	</div>
	<div class="card-body">
		<h4 class="text-right"><strong> $ {{ $product->Price }}</strong></h4>
		<h5 class="card-title">{{ $product->Title }}</h5>
		<p class="card-text">{{ $product->Description }}</p>
		<p class="card-text"><strong>{{ $product->Stock }} left </strong></p>
		@if(isset($cart))
			<p class="card-text">{{ $product->pivot->quantity }} in your car <strong>(${{ $product->total }})</strong></p>
			<form 
			method="POST" 
			action="{{ route('products.carts.destroy',['cart' => $cart->id, 'product' => $product->id]) }}" 
			class="d-inline"
			>
				@csrf
				@method('DELETE')
				<button type="submit" class="btn btn-warning">Remove From cart</button>
			</form>  
		@else
			<form 
				method="POST" 
				action="{{ route('products.carts.store',['product' => $product->id]) }}" 
				class="d-inline"
			>
				@csrf
				<button type="submit" class="btn btn-success">Add to cart</button>
			</form>
		@endif
	</div>
</div>

{{-- 
<h1>{{$product->Title}} {{$product-> id}}</h1>
<p>{{$product->Description}}</p>
<p>{{$product->Price}}</p>
<p>{{$product->Stock}}</p>
<p>{{$product->Status}}</p> --}}