@extends('backend.layouts.app')

@section('Page-Heading', 'Edit User')

@section('content')

	<!-- Basic Forms -->
<div class="col-md-9">
	<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit User : {{$user->name}}</h3>
          <!-- <h6 class="box-subtitle">Bootstrap Form Validation check the <a href="http://reactiveraven.github.io/jqBootstrapValidation/">official website </a></h6> -->

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        	@if(Session::has('success_msg'))
				<p class="alert alert-success fade-message">{{ Session::get('success_msg') }}</p>
			@elseif(Session::has('primary_msg'))
			<p class="alert alert-primary fade-message">{{ Session::get('primary_msg') }}</p>
			@elseif(Session::has('error_msg'))
				<p class="alert alert-danger fade-message">{{ Session::get('error_msg') }}</p>
			@endif
          	<div class="row">
	            <div class="col">
	            	<form action="{{ route('accounts.update', $user->id) }}" method="post">
	            		@csrf
	            		@method('PUT')
	            		<div class="row">
	            			<div class="col-lg-6">
								<div class="form-group">
									<h5>Name <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ $user->name }}"> 
									</div>
									@error('name')
									    <p class="validate">
									      {{ $message }}
									    </p>
									@enderror
								</div>
	            			</div>
	            			<div class="col-lg-6">
								<div class="form-group">
									<h5>Email <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{ $user->email }}"> 
									</div>
									@error('email')
									    <p class="validate">
									      {{ $message }}
									    </p>
									@enderror
								</div>            				
	            			</div>
	            		</div>




	            		<div class="row">
	            			<div class="col-lg-12">
								<div class="form-group">
									<h5>Password <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="password" name="password" class="form-control" placeholder="Enter Password"> 
									</div>
									@error('password')
									    <p class="validate">
									      {{ $message }}
									    </p>
									@enderror
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-lg-8">
								<div class="form-group">
									<h5>Phone <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="number" name="phone" class="form-control" placeholder="Enter Phone" value="{{ $user->phone }}"> 
									</div>
									@error('phone')
									    <p class="validate">
									      {{ $message }}
									    </p>
									@enderror
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<div class="form-group">
										<h5>Status <span class="text-danger">*</span></h5>
										<div class="controls">
											<fieldset>
												<label class="custom-control custom-checkbox">
													<input type="checkbox" value="1" name="status" class="custom-control-input" <?php if ($user->status == 1): ?>
														<?php echo 'checked' ?>
													<?php endif ?>> <span class="custom-control-indicator"></span> <span class="custom-control-description">ON</span> </label>
											</fieldset>
										</div>
										@error('status')
										    <p class="validate">
										      {{ $message }}
										    </p>
										@enderror
									</div>
								</div>
							</div>
						</div>


						<div class="form-group">
	            			<h5>Assign Roles <span class="text-danger">*</span></h5>
							<div class="box-body">
								<div class="demo-checkbox">
									@foreach($roles as $role)
										<input type="checkbox" name="role[]" id="{{ $role->name }}" class="chk-col-blue" value="{{ $role->id }}" {{ in_array($role->id, $user_role) ? 'checked' : ''}}>
										<label for="{{ $role->name }}">{{ $role->name }}</label>
									@endforeach
								</div>
				            </div>
			            </div>


						
						
					
						<div class="text-xs-right">
							<button type="submit" class="btn btn-info">Edit user</button>
						</div>
					</form>
	            	
	            </div>
	            <!-- /.col -->
          	</div>
          	<!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
      <!-- /.box -->
</div>

@endsection

@section('scripts')
	
	<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize&language=en&region=GB" async defer></script>
	<script src="{{ asset('admin/js/mapInput.js') }}"></script>


@endsection