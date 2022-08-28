@extends('Layouts.app')
@section('content')
	<h1>Lista de Usuarios</h1>
	
	@empty($users)
	<div>
		No hay datos en la tabla
	</div>
	@else

	<div class="table-responsive">
		<table class="table table-striped">
			<thead class="thead-light">
				<tr>
					<th>Id</th>
					<th>name</th>
					<th>Email</th>
					<th>Admin Since</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
					<tr>
						<td>{{$user->id}}</td>
						<td>{{$user->name}}</td>
						<td>{{$user->email}}</td>
						{{-- <td>{{option($user->admin_since)->diffForHumans() ?? 'Never'}}</td> --}}
						<td>
							{{ optional($user->admin_since)->diffForHumans() ?? 'Never' }}
						</td>
						<td>
							{{-- @dump($user) --}}
							<form method="POST" class="d-inline" action="{{ route('users.admin.toggle',['user'=>$user->id]) }}">
								@csrf
								<button type="submit" class="btn btn-link">
									{{ $user->isAdmin() ? 'Remove' : 'Make' }}
								</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif
@endsection