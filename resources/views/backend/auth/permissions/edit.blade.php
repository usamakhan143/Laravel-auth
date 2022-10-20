@extends('backend.layouts.app')

@section('Page-Heading', 'Edit Permission '.$peredit->name)

@section('content')

	<!-- Basic Forms -->
<div class="col-md-5">
	<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Permission</h3>
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
	            	<form action="{{ route('permissions.update', $peredit->id) }}" method="post">
	            		@csrf
	            		@method('PUT')
						
						<div class="form-group">
							<h5>Permission Name <span class="text-danger">*</span></h5>
							<div class="controls">
								<input type="text" name="name" class="form-control" placeholder="Enter Permission Name" value="{{ $peredit->name }}"> 
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

									<option value="attendance_post-type" <?php if ($peredit->for == 'attendance_post-type') {
										echo "selected";
									}  ?>>Attendance</option>

									<option value="posttype_post-type" <?php if ($peredit->for == 'posttype_post-type') {
										echo "selected";
									}  ?>>Parking Slots</option>

									<option value="users_post-type" <?php if ($peredit->for == 'users_post-type') {
										echo "selected";
									}  ?>>Users</option>

									<option value="roles_post-type" <?php if ($peredit->for == 'roles_post-type') {
										echo "selected";
									}  ?>>Roles</option>

									<option value="permissions_post-type" <?php if ($peredit->for == 'permissions_post-type') {
										echo "selected";
									}  ?>>Permissions</option>
									
									<option value="shifts_post-type" <?php if ($peredit->for == 'shifts_post-type') {
										echo "selected";
									}  ?>>Shifts</option>

									<option value="dashboard-panel" <?php if ($peredit->for == 'dashboard-panel') {
										echo "selected";
									}  ?>>Dashboard Panel</option>

									<option value="networks_post-type" <?php if ($peredit->for == 'networks_post-type') {
										echo "selected";
									}  ?>>Networks</option>

									<option value="other_post-type" <?php if ($peredit->for == 'other_post-type') {
										echo "selected";
									}  ?>>Other</option>
								</select>
							</div>
							@error('per_for')
							    <p class="validate">
							      {{ $message }}
							    </p>
							@enderror
						</div>
						
					
						<div class="text-xs-right">
							<button type="submit" class="btn btn-info">Edit permission</button>
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