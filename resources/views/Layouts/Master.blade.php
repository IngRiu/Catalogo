<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	{{-- @dump($errors) --}}

	{{-- @if(session()->has('error'))
	<div class="alert alert-danger">
		{{session()->get('error')}}
	</div>
	@endif --}}

	@if(session()->has('success'))
	<div class="alert alert-success">
		{{session()->get('success')}}
	</div>
	@endif

	@if(isset($errors) && $errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
	@endif
	@yield('content')
</body>
</html>