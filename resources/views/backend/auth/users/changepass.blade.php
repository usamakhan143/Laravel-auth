@extends('backend.layouts.app')

@section('Page-Heading', 'Change Password')

@section('content')

	{{-- Basic Forms --}}
	<div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Change Password</h3>
          {{-- <h6 class="box-subtitle">Bootstrap Form Validation check the <a href="http://reactiveraven.github.io/jqBootstrapValidation/">official website </a></h6> --}}

        </div>
        {{-- /.box-header --}}
        <div class="box-body">
        	@if(Session::has('success-msg'))
				<p class="alert alert-success fade-message">{{ Session::get('success-msg') }}</p>
			@elseif(Session::has('primary_msg'))
			<p class="alert alert-primary fade-message">{{ Session::get('primary_msg') }}</p>
			@elseif(Session::has('error_msg'))
				<p class="alert alert-danger fade-message">{{ Session::get('error_msg') }}</p>
			@endif
          <div class="row">
            <div class="col">
            	<form action="{{ route('changed.pass', Auth::user()->id) }}" method="post">
            		@csrf
            		@method('PUT')
					<div class="form-group">
						<h5>Last Password <span class="text-danger">*</span></h5>
						<div class="controls">
							<input type="password" name="lpass" class="form-control" placeholder="Enter your previous password" value="{{ old('lpass') }}" /> 
						</div>
						@error('lpass')
						    <p class="validate">
						      {{ $message }}
						    </p>
						@enderror
					</div>

					<div class="form-group">
						<h5>New Password <span class="text-danger">*</span></h5>
						<div class="controls">
							<input type="password" name="newpass" class="form-control" placeholder="Enter your new password" /> 
						</div>
						@error('newpass')
						    <p class="validate">
						      {{ $message }}
						    </p>
						@enderror
					</div>
				
					<div class="text-xs-right">
						<button type="submit" class="btn btn-info">Change now</button>
					</div>
				</form>
            	
            </div>
            {{-- /.col --}}
          </div>
          {{-- /.row --}}
        </div>
        {{-- /.box-body --}}
      </div>
      {{-- /.box --}}
  </div>

@endsection