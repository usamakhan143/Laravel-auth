@extends('backend.layouts.app')

@section('Page-Heading', 'Edit Holiday')

@section('backend_head')

    {{-- Theme style --}}
    <link rel="stylesheet" href="{{ asset('backend/css/master_style.css') }}">

@endsection

@section('content')

	<!-- Basic Forms -->
	<div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit this Holiday</h3>
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
            	<form action="{{ route('holiday.update', $hol->id) }}" method="post" class="prevent-form-multiple-submit">
            		@csrf
                    @method('PUT')
					<div class="form-group">
						<h5>Holiday Name <span class="text-danger">*</span></h5>
						<div class="controls">
							<input type="text" name="name" value="{{ $hol->name }}" class="form-control" placeholder="Enter Holiday Name"> 
						</div>
						@error('name')
						    <p class="validate">
						      {{ $message }}
						    </p>
						@enderror
					</div>

                    <div class="form-group">
                        <h5>Description <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <textarea name="description" class="form-control" placeholder="Enter description">{{ $hol->description }}</textarea> 
                        </div>
                        @error('description')
                            <p class="validate">
                            {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <h5>Date <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="date" name="date" class="form-control" placeholder="Select Date"> 
                                </div>
                                @error('date')
                                    <p class="validate">
                                    {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <h5>Status <span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <fieldset>
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" value="1" name="status" class="custom-control-input" <?php if ($hol->status == 1): ?>
                                                                <?php echo 'checked' ?>
                                                            <?php endif ?>> <span class="custom-control-indicator"></span> <span class="custom-control-description">ON</span> 
                                                        </label>
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
					
				
					<div class="text-xs-right">
						<button type="submit" class="btn btn-info prevent-button-multiple-submit"><i class="spinner fas fa-spinner fa-spin"></i> Edit Holiday</button>
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