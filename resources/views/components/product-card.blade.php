<div class="card">
	<img class="card-img-top" src="{{ asset($product->images->first()->path) }}" height="500">
	<div class="card-body">
		<h4 class="text-right"><strong>${{ $product->Price }}</strong></h4>
		<h5 class="card-title">{{ $product->Title }}</h5>
		<p class="card-text">{{ $product->Description }}</p>
		<p class="card-text"><strong>{{ $product->Stock }} left </strong></p>
	</div>
</div>

{{-- 
<h1>{{$product->Title}} {{$product-> id}}</h1>
<p>{{$product->Description}}</p>
<p>{{$product->Price}}</p>
<p>{{$product->Stock}}</p>
<p>{{$product->Status}}</p> --}}