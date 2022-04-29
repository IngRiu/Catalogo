@extends('Layouts.app')
@section('content')
	<h1>{{$product->Title}} {{$product-> id}}</h1>
	<p>{{$product->Description}}</p>
	<p>{{$product->Price}}</p>
	<p>{{$product->Stock}}</p>
	<p>{{$product->Status}}</p>
@endsection