@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row page-title-row">
		<div class="col-md-12">
			<h3>
				User <small>&raquo; Add New User</small>
			</h3>

		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						Student Form
					</h3>
				</div>
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
					    @foreach ($errors->all() as $error)
					    <li>{{ $error }}</li>
					     @endforeach       
					    </ul>
					</div>
				@endif
				<div class="panel-body">					
					<form action="{{ route('user.store')}}" role="form" method="POST" class="form-horizontal">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<label for="name" class="col-md-2 control-label">
										 Name           
									</label>

									
									@if($errors->has('name'))
										{{ $errors->first('name') }}
									@endif
									
									<div class="col-md-10">
										<input type="text"  class="form-control" name="name" id="name" value= "{{ old('name') }}">
									</div>
								</div>
								<div class="form-group">
									<label for="email" class="col-md-2 control-label">
										Email
									</label>
									<div class="col-md-10">
										<input type="text" name="email"  class="form-control" id="email" value="{{ old('email') }}">
									</div>
								</div>
								<div class="form-group">
									<label for=password" class="col-md-2 control-label">
										Password
									</label>
									<div class="col-md-10">
										<input type="password" name="password"  class="form-control" id="email" value="">
									</div>
								</div>
								<div class="form-group">
									<label for="bio" class="col-md-2 control-label">
										Bio
									</label>
									<div class="col-md-10">
										<textarea name="bio" id="bio" value="{{ old('bio') }}"></textarea>
									</div>
								</div>
								<div class="form-group">
									<label for="photo_path" class="col-md-2 control-label">
										Photo
									</label>
									<div class="col-md-10">
										<input type="text" name="photo_path"  class="form-control" id="photo_path" value="{{ old('photo_path') }}">
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<div class="col-md-10 col-md-offset-2">
											<button type="submit" class="btn btn-primary btn-lg">
												<i class="fa fa-disk-o">													
												</i>
												Save New Student
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

