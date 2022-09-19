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

		 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('Page-Heading')
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{-- route('admin.home') --}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <!-- <li class="breadcrumb-item"><a href="#">Examples</a></li> -->
        <li class="breadcrumb-item active">@yield('Page-Heading')</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <!-- <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Title</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          This is some text within a card block.
        </div>
        
        <div class="box-footer">
          Footer
        </div>
        
      </div> -->
      <!-- /.box -->
      @section('content')

        @show

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

		@include('backend.layouts.footer')

	</div>

</body>
</html>