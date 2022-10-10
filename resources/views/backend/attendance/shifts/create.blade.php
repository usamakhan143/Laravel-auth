@extends('backend.layouts.app')

@section('Page-Heading', 'Add New Shift')

@section('content')

	<!-- Basic Forms -->
	<div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Add a Shift</h3>
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
            	<form action="{{ route('shift.store') }}" method="post">
            		@csrf
					<div class="form-group">
						<h5>Shift Name <span class="text-danger">*</span></h5>
						<div class="controls">
							<input type="text" name="name" class="form-control" placeholder="Enter Shift Name"> 
						</div>
						@error('name')
						    <p class="validate">
						      {{ $message }}
						    </p>
						@enderror
					</div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <h5>Start Time <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="time" name="start_time" class="form-control" placeholder="Enter Start Time"> 
                                </div>
                                @error('start_time')
                                    <p class="validate">
                                    {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="col">
                                <h5>End Time <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="time" name="end_time" class="form-control" placeholder="Enter End Time"> 
                                </div>
                                @error('end_time')
                                    <p class="validate">
                                    {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
					</div>

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
					
				
					<div class="text-xs-right">
						<button type="submit" class="btn btn-info">Add shift</button>
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