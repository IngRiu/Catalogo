@extends('Layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Panel de administracion</div>
                
                <div class="card-body">
                    <div class="list-group">
                        <a class="list-group-item" href="{{ route('products.index') }}">
                            Manage products
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
