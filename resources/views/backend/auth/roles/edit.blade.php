@extends('backend.layouts.app')

@section('Page-Heading', 'Edit Role '.$roleedit->name)

@section('content')

	<!-- Basic Forms -->
<div class="col-md-12">
	<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Role</h3>
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
	            	<form action="{{ route('role.update', $roleedit->id) }}" method="post">
	            		@csrf
	            		@method('PUT')
						
						<div class="form-group">
							<h5>Role Name <span class="text-danger">*</span></h5>
							<div class="controls">
								<input type="text" name="name" class="form-control" placeholder="Enter Role Name" value="{{ $roleedit->name }}"> 
							</div>
							@error('name')
							    <p class="validate">
							      {{ $message }}
							    </p>
							@enderror
						</div>

						<div class="row">

				            <div class="col-lg-3 pt-4 pb-4">
				            	<h5>Post-type Permissions <span class="text-danger">*</span></h5>
				            	<div class="demo-checkbox">

				            		@foreach($permissions as $detail)
				            			@if($detail->for == 'posttype_post-type')
											
											<input type="checkbox" name="permissions[]" id="{{ $detail->name }}" class="chk-col-blue" value="{{ $detail->id }}" {{ in_array($detail->id, $rolepr) ? 'checked' : ''}}>
											<label for="{{ $detail->name }}">{{ $detail->name }}</label>

										@endif
									@endforeach

				            	</div>
				            </div>
				            <div class="col-lg-3 pt-4 pb-4">
				            	<h5>Users Permissions <span class="text-danger">*</span></h5>
				            	<div class="demo-checkbox">
				            		
				            		@foreach($permissions as $detail)
				            			@if($detail->for == 'users_post-type')
											<input type="checkbox" name="permissions[]" id="{{ $detail->name }}" class="chk-col-blue" value="{{ $detail->id }}" {{ in_array($detail->id, $rolepr) ? 'checked' : ''}}>
											<label for="{{ $detail->name }}">{{ $detail->name }}</label>
										@endif
									@endforeach

				            	</div>
				            </div>

				            <div class="col-lg-3 pt-4 pb-4">
			            	<h5>Role Permissions <span class="text-danger">*</span></h5>
			            	<div class="demo-checkbox">
			            		
			            		@foreach($permissions as $detail)
			            			@if($detail->for == 'roles_post-type')
										<input type="checkbox" name="permissions[]" id="{{ $detail->name }}" class="chk-col-blue" value="{{ $detail->id }}" {{ in_array($detail->id, $rolepr) ? 'checked' : ''}}>
										<label for="{{ $detail->name }}">{{ $detail->name }}</label>
									@endif
								@endforeach

			            	</div>
			            </div>

			            <div class="col-lg-3 pt-4 pb-4">
			            	<h5>Permissions <span class="text-danger">*</span></h5>
			            	<div class="demo-checkbox">
			            		
			            		@foreach($permissions as $detail)
			            			@if($detail->for == 'permissions_post-type')
										<input type="checkbox" name="permissions[]" id="{{ $detail->name }}" class="chk-col-blue" value="{{ $detail->id }}" {{ in_array($detail->id, $rolepr) ? 'checked' : ''}}>
										<label for="{{ $detail->name }}">{{ $detail->name }}</label>
									@endif
								@endforeach

			            	</div>
			            </div>

				            <div class="col-lg-3 pt-4 pb-4">
				            	<h5>Other Permissions <span class="text-danger">*</span></h5>
				            	<div class="demo-checkbox">
				            		
				            		@foreach($permissions as $detail)
				            			@if($detail->for == 'other_post-type')
											<input type="checkbox" name="permissions[]" id="{{ $detail->name }}" class="chk-col-blue" value="{{ $detail->id }}" {{ in_array($detail->id, $rolepr) ? 'checked' : ''}}>
											<label for="{{ $detail->name }}">{{ $detail->name }}</label>
										@endif
									@endforeach

				            	</div>
				            </div>
			            	
			            </div>
						
					
						<div class="text-xs-right">
							<button type="submit" class="btn btn-info">Edit role</button>
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