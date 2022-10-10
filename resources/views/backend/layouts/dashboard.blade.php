@extends('backend.layouts.app')

@section('Page-Heading', 'Dashboard')

@section('content')

<div class="row">

    @can('employees', Auth::user())
        <div class="col-xl-3 col-md-6 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
            <h3>{{$numbers_of_emp}}</h3>

            <p>Employees</p>
            </div>
            <div class="icon">
            <i class="fa fa-users"></i>
            </div>
            <a href="{{route('all.accounts')}}" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
        </div>
        </div>
    @endcan

    {{-- <div class="col-xl-3 col-md-6 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>67<sup style="font-size: 20px">%</sup></h3>

          <p>Sales Rate</p>
        </div>
        <div class="icon">
          <i class="fa fa-bar-chart"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-xl-3 col-md-6 col-6">
      <!-- small box -->
      <div class="small-box bg-primary">
        <div class="inner">
          <h3>78</h3>

          <p>Registrations</p>
        </div>
        <div class="icon">
          <i class="fa fa-user-plus"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-xl-3 col-md-6 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>65</h3>

          <p>New Visitors</p>
        </div>
        <div class="icon">
          <i class="fa fa-pie-chart"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div> --}}

@endsection