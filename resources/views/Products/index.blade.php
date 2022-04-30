@extends('Layouts.app')
@section('content')
<a href="{{ route('products.create') }}" class="btn btn-success mb-3">Create</a>
	@empty($products)
	<div>
		No hay datos en la tabla
	</div>
	@else
	<h1>Lista de productos</h1>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead class="thead-light">
				<tr>
					<th>Id</th>
					<th>Title</th>
					<th>Descripcion</th>
					<th>Price</th>
					<th>Stock</th>
					<th>Staus</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $product)
					<tr>
						<td>{{$product->id}}</td>
						<td>{{$product->Title}}</td>
						<td>{{$product->Description}}</td>
						<td>{{$product->Price}}</td>
						<td>{{$product->Stock}}</td>
						<td>{{$product->Status}}</td>
						<td>
							{{-- <a href="{{ route('products.show',[$product->Title]) }}">Show</a> --}}
							<a href="{{ route('products.show',[$product->id]) }}">Show</a>
							<a href="{{ route('products.edit',['product'=>$product->id]) }}">Edit</a>
							<form method="POST" class="d-inline" action="{{ route('products.destroy',['product'=>$product->id]) }}">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-link">Delete</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif
@endsection