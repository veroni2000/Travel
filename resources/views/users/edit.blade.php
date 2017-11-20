@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row page-title-row">
		<div class="col-md-12">
			<h3>
				User <small>&raquo; Edit User</small>
			</h3>

		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
					    @foreach ($errors->all() as $error)
					    <li>{{ $error }}</li>
					     @endforeach       
					    </ul>
					</div>
				@endif
				</div>
				<div class="panel-body">					
					<form action="{{ route('user.update', $user->id)}}" role="form" method="POST" class="form-horizontal">
					
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="_method" value="PUT">
						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<label for="name" class="col-md-2 control-label">
										 Name           
									</label>
									<div class="col-md-10">
										<input type="text"  class="form-control" name="name" id="name" value= "{{ $user->name }}">
									</div>
								</div>
								<div class="form-group">
									<label for="email" class="col-md-2 control-label">
										Email
									</label>
									<div class="col-md-10">
										<input type="text" name="email"  class="form-control" id="email" value="{{ $user->email }}">
									</div>
								</div>
								<div class="form-group">
									<label for=password" class="col-md-2 control-label">
										Password
									</label>
									<div class="col-md-10">
										<input type="password" name="password"  class="form-control" id="password" value="">
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<div class="col-md-10 col-md-offset-2">
											<button type="submit" class="btn btn-primary btn-lg">
												<i class="fa fa-disk-o">													
												</i>
												Edit User
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

