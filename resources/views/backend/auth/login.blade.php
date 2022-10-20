<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('backend/images/small-visech-dark.png') }}">

    <title>Admin - Log in </title>
  
	{{-- <!-- Bootstrap 4.0--> --}}
  <link rel="stylesheet" href="{{ asset('backend/assets/vendor_components/bootstrap/dist/css/bootstrap.css') }}">

  {{-- <!-- Bootstrap 4.0--> --}}
  <link rel="stylesheet" href="{{ asset('backend/assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css') }}">

	
  {{-- <!-- theme style --> --}}
  <link rel="stylesheet" href="{{ asset('backend/css/master_style.css') }}">

  {{-- <!-- Unique Admin skins. choose a skin from the css/skins folder instead of downloading all of them to reduce the load. --> --}}
  <link rel="stylesheet" href="{{ asset('backend/css/skins/_all-skins.css') }}">


</head>
<body class="hold-transition login-page" style="background-color:#3644AF">
<div class="login-box" style="width: 380px">
  <div class="login-logo">
    <a href="#"><b>VISECH</b></a>
  </div>
  {{-- <!-- /.login-logo --> --}}
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    @if($errors->any())
        <div class="fade-message" style="color: red; padding: 10px; background-color: rgba(255,0,0,0.1); border: 1px solid red;">
          {!! implode('', $errors->all('<li>:message</li>')) !!}
        </div>
    @endif

    <form action="{{ route('company.login') }}" method="post" class="form-element">
      @csrf
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" autocomplete="email" name="email">
        <span class="ion ion-email form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="current-password">
        
          <span class="ion ion-locked form-control-feedback"></span>
      </div>
      <div class="row">
        {{-- <!-- <div class="col-6">
          <div class="checkbox">
            <input type="checkbox" id="basic_checkbox_1" >
			      <label for="basic_checkbox_1">Remember Me</label>
          </div>
        </div> -->
        <!-- /.col -->
        <!-- <div class="col-6">
         <div class="fog-pwd">
          	<a href="javascript:void(0)"><i class="ion ion-locked"></i> Forgot pwd?</a><br>
          </div>
        </div> --> --}}
        {{-- <!-- /.col --> --}}
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-info btn-block margin-top-10">SIGN IN</button>
        </div>
        {{-- <!-- /.col --> --}}
      </div>
    </form>

  </div>
  {{-- <!-- /.login-box-body --> --}}
</div>
{{-- <!-- /.login-box --> --}}


  {{-- <!-- jQuery 3 --> --}}
  <script src="{{ asset('backend/assets/vendor_components/jquery/dist/jquery.js') }}"></script>
  <script src="{{ asset('assets/vendor_components/jquery/dist/jquery.min.js') }}"></script>
	
  {{-- <!-- popper --> --}}
  <script src="{{ asset('backend/assets/vendor_components/popper/dist/popper.min.js') }}"></script>
  
  {{-- <!-- Bootstrap 4.0--> --}}
  <script src="{{ asset('backend/assets/vendor_components/bootstrap/dist/js/bootstrap.js') }}"></script>

  <script type="text/javascript">
    $(function(){
        setTimeout(function() {
            $('.fade-message').fadeToggle();
        }, 10000);
    });
  </script>

</body>
</html>