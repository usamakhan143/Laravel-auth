<!DOCTYPE html>
<html>
<head>
	
	@include('backend.layouts.head')

</head>

<style type="text/css">
  .validate{
      color: red;
      padding-top: 5px;
      font-size: 14px;
     }

  tr[data-href]{
    cursor: pointer;
  }
</style>

<body class="hold-transition skin-blue sidebar-mini">

	<div class="wrapper">

		@include('backend.layouts.header')

		@include('backend.layouts.sidebar')

  <div class="content-wrapper">
    
    <section class="content-header">

      <h1> @yield('Page-Heading') </h1>
      
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">@yield('Page-Heading')</li>
      </ol>
    
    </section>

    {{-- Main content --}}
    <section class="content">

      @section('content')

        @show

    </section>
    {{-- Main content --}}


  </div>

		@include('backend.layouts.footer')

	</div>

</body>
</html>