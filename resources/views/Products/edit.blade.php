@extends('Layouts.app')
@section('content')
	<h1>Edit Product</h1>
	<form method="POST" action="{{ route('products.update', ['product' => $product->id]) }}">
		@csrf
		@method('PUT')
		<div class="form-row">
			<label>Title</label>
			<input type="text" value="{{ old('Title') ?? $product->Title}}" name="Title" class="form-control" required>
		</div>
		<div class="form-row">
			<label>Description</label>
			<input class="form-control" type="text" name="Description" value="{{ old('Description') ?? $product->Description}}" required>
		</div>
		<div class="form-row">
			<label>Price</label>
			<input class="form-control" type="number" name="Price" value="{{ old('Price') ?? $product->Price}}" min="1" step="0.01" required>
		</div>
		<div class="form-row">
			<label>Stock</label>
			<input type="number" name="Stock" value="{{ old('Stock') ?? $product->Stock}}" class="form-control" min="0"  required>
		</div>
		<div class="custom-select">
			<label>Status</label>
			<select name="Status" class="custom-select" required>
				<option {{ old('Status') == 'available' ? 'selected' : ($product->Status == 'available' ? 'selected' : '')}} value="available">available</option>
				<option {{ old('Status') == 'unavailable' ? 'selected' : ($product->Status == 'unavailable' ? 'selected' : '')}} value="unavailable">unavailable</option>
			</select>
		</div>
		<div class="form-row mt-3">
			<button type="submit" class="btn btn-primary btn-lg">Editar</button>
		</div>
	</form>
@endsection