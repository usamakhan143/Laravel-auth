@extends('backend.layouts.app')

@section('Page-Heading', 'Add New Permission for role')

@section('backend_head')

    {{-- Theme style --}}
    <link rel="stylesheet" href="{{ asset('backend/css/master_style.css') }}">

@endsection

@section('content')

	<!-- Basic Forms -->
	<div class="col-md-5">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Add a Permission</h3>
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
            	<form action="{{ route('permissions.store') }}" class="prevent-form-multiple-submit" method="post">
            		@csrf
					<div class="form-group">
						<h5>Permission Name <span class="text-danger">*</span></h5>
						<div class="controls">
							<input type="text" name="name" class="form-control" placeholder="Enter Permission Name"> 
						</div>
						@error('name')
						    <p class="validate">
						      {{ $message }}
						    </p>
						@enderror
					</div>

					<div class="form-group">
						<h5>Permission For <span class="text-danger">*</span></h5>
						<div class="controls">
							<select name="per_for" class="form-control">
								<option value="">Select Permission for</option>
								<option value="attendance_post-type">Attendance</option>
								<option value="users_post-type">Users</option>
								<option value="roles_post-type">Roles</option>
								<option value="permissions_post-type">Permissions</option>
								<option value="shifts_post-type">Shifts</option>
								<option value="dashboard-panel">Dashboard Panel</option>
								<option value="networks_post-type">Networks</option>
								<option value="reports_post-type">Report</option>
								<option value="holidays_post-type">Holidays</option>
								<option value="other_post-type">Other</option>
							</select>
						</div>
						@error('per_for')
						    <p class="validate">
						      {{ $message }}
						    </p>
						@enderror
					</div>
					
				
					<div class="text-xs-right">
						<button type="submit" class="btn btn-info prevent-button-multiple-submit"><i class="spinner fas fa-spinner fa-spin"></i> Add permission</button>
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

    <script src="{{ asset('backend/js/forms/submit.js') }}"></script>

@endsection