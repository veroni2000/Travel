@extends('layouts.app')

@section('style')

<link rel="stylesheet" type="text/css" href="">

@endsection

@section('content')
<div class="container">
<div class="row">
	<div class="col-md-6">
		<h1>Users</h1>
	</div>	
</div>
@if(Session::has('message'))
<div class="alert alert-success">
	<button class="close" type="button" data-dismiss="alert">&times;</button>
	<strong>
		<i class="fa fa-check-circle fa-lg fa-fw"></i>Success. &nbsp;
	</strong>
	{{ Session::get('message') }}
</div>
@endif
<div class="row">
<table class="table">
	<tr>
		<td>
			User Name
		</td>
		<td>
			User Role
		</td>
		<td>
			Edit User
		</td>
		<td>
			Delete User
		</td>
	</tr>
	@foreach($users as $user)
	<tr>
		<td>
				{{ $user->name }}						
		</td>
		<td>
			{{ $user->role }}
		</td>
		<td>
			<a href="{{ route('edit_user_info', $user->id) }}" class="btn btn-info">Edit</a>
		</td>
		<td>
			
		</td>
	</tr>
@endforeach
</table>
<div class="row">
	<div class="col-md-6">
		<a href="{{ route('add_new_user') }}" class="btn btn-info">Add New User</a>
	</div>
</div>
</div>
</div>
@endsection