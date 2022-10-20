@extends('backend.layouts.app')

@section('Page-Heading', 'Mark Your Attendance')

@section('content')


<div class="row">
    <div class="col-xl-3 col-md-6 col">
        <div class="info-box">
          <a href="{{ route('mark.instore') }}"><span class="info-box-icon bg-info"><i class="fa fa-sign-in"></i></span></a>

          <div class="info-box-content">
            <span class="info-box-number">Check IN<small></small></span>
            <span class="info-box-text">I am present</span>
          </div>
        </div>
    </div>
</div>



@endsection