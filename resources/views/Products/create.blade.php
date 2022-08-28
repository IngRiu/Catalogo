@extends('Layouts.app')
@section('content')
	<h1>Create new product</h1>
	<form 
	method="POST" 
	action="{{ route('products.store') }}"
	enctype="multipart/form-data"
	>
		@csrf
		<div class="form-row">
			<label>Title</label>
			<input type="text" name="Title" class="form-control" value="{{ old('Title') }}" required>
		</div>
		<div class="form-row">
			<label>Desciption</label>
			<input type="text" name="Description" class="form-control" value="{{ old('Description') }}" required>
		</div>
		<div class="form-row">
			<label>Price</label>
			<input type="number" name="Price" min="1.00" step="0.01" class="form-control" value="{{ old('Price') }}" required>
		</div>
		<div class="form-row">
			<label>Stock</label>
			<input type="number" name="Stock" min="0" class="form-control" value="{{ old('Stock') }}" required>
		</div>
		<div class="form-row">
			<label>Status</label>
			<select class="custom-select" name="Status" required 
			>
				<option value="">Select...</option>
				<option {{ old('Status') == 'available' ? 'selected'  : '' }} value="available">Available</option>
				<option {{ old('Status') == 'unavailable' ? 'selected'  : '' }} value="unavailable">Unavailable</option>
			</select>
		</div>
		<div class="form-row">
            <label>
            	{{ __('Images') }}
            </label>
            
            <div class="custom-file">
                <input type="file" accept="image/*" name="images[]" class="custom-file-input" multiple>
                <label class="custom-file-label">
                    Product images...
                </label>
            </div>
        </div>
		<div class="form-row">
			<button type="submit" class="btn btn-primary btn-lg mt-3">Create Product</button>
		</div>
	</form>
@endsection