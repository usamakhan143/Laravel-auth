@extends('backend.layouts.app')

@section('Page-Heading', 'Add New Account for VISECH')

@section('backend_head')
	
	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="{{ asset('admin/assets/vendor_components/bootstrap-switch/switch.css') }}">

@endsection

@section('content')

	<!-- Basic Forms -->
	<div class="col-md-8">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Create an Account</h3>
          <!-- <h6 class="box-subtitle">Bootstrap Form Validation check the <a href="http://reactiveraven.github.io/jqBootstrapValidation/">official website </a></h6> -->

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
            	<form action="{{ route('accounts.store') }}" method="post">
            		@csrf

            		<div class="row">
            			<div class="col-lg-6">
							<div class="form-group">
								<h5>Name <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ old('name') }}"> 
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
									<input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{ old('email') }}"> 
								</div>
								@error('email')
								    <p class="validate">
								      {{ $message }}
								    </p>
								@enderror
							</div>            				
            			</div>
            		</div>

            		{{-- <div class="row">
            			<div class="col-lg-6">
							<div class="form-group">
								<h5>Password <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="password" name="password" class="form-control" placeholder="Enter Password" value="{{ old('password') }}"> 
								</div>
								@error('password')
								    <p class="validate">
								      {{ $message }}
								    </p>
								@enderror
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<h5>Confirm Password <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="password" name="password_confirmation" class="form-control" placeholder="Enter Confirm Password"> 
								</div>
								@error('password_confirmation')
								    <p class="validate">
								      {{ $message }}
								    </p>
								@enderror
							</div>							
						</div>
					</div> --}}


					<div class="row">
						<div class="col-lg-5">
							<div class="form-group">
								<h5>Phone <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="number" name="phone" class="form-control" placeholder="Enter Phone" value="{{ old('phone') }}"> 
								</div>
								@error('phone')
								    <p class="validate">
								      {{ $message }}
								    </p>
								@enderror
							</div>
						</div>

						<div class="col-lg-5">
							{{-- <div class="form-group">
								<label>Select Working Hours</label>
								<select class="form-control">
								  <option>Morning</option>
								</select>
							</div> --}}

							<div class="form-group">
								<label>Hiring Date</label>
								<div class="controls">
									<input class="form-control" type="date" name="hireDate"/>
								</div>
								@error('hireDate')
									<p class="validate">
										{{ $message }}
									</p>
								@enderror
							</div>
						</div>

						<div class="col-lg-2">
							<div class="form-group">
								<div class="form-group">
									<h5>Status <span class="text-danger"></span></h5>
									<div class="controls">
										<fieldset>
											<label class="custom-control custom-checkbox">
												<input type="checkbox" value="1" name="status" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">ON</span> </label>
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
            			<h5>Assign Shift <span class="text-danger">*</span></h5>
						<div class="box-body">
							<div class="demo-checkbox">
								@foreach($shifts as $shift)
									<input type="checkbox" name="shift[]" id="{{ $shift->name }}" class="chk-col-blue" value="{{ $shift->id }}">
									<label for="{{ $shift->name }}">{{ $shift->name }}</label>
								@endforeach
							</div>
							@error('shift')
							    <p class="validate">
							      {{ $message }}
							    </p>
							@enderror
			            </div>
		            </div>

					<div class="form-group">
            			<h5>Assign Roles <span class="text-danger">*</span></h5>
						<div class="box-body">
							<div class="demo-checkbox">
								@foreach($roles as $role)
									<input type="checkbox" name="role[]" id="{{ $role->name }}" class="chk-col-blue" value="{{ $role->id }}">
									<label for="{{ $role->name }}">{{ $role->name }}</label>
								@endforeach
							</div>
							@error('role')
							    <p class="validate">
							      {{ $message }}
							    </p>
							@enderror
			            </div>
		            </div>
	
				
					<div class="text-xs-right">
						<button type="submit" class="btn btn-info">Add account</button>
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