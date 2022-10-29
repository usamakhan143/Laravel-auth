@extends('backend.layouts.app')

@section('Page-Heading', 'Dashboard')

@section('content')

    <div class="row">

        @can('employees', Auth::user())
            <div class="col-xl-3 col-md-6 col-6">
                <!-- small box -->
                <div class="small-box bg-info p-10">
                    <div class="inner">
                        <h3>{{ $numbers_of_emp }}</h3>

                        <p>Employees</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="{{ route('all.accounts') }}" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 col-6">
                <!-- small box -->
                <div class="small-box bg-info p-10">
                    <div class="inner">
                        <h3>{{ $total_present }} / {{ $numbers_of_emp }}</h3>

                        <p>Total Present</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        @endcan

        @can('employees.insideoffice', Auth::user())
            <div class="col-md-6">
                @if($check_record > 0)
                <div class="box">
                    <div class="box-header with-border">
                        <h5 class="box-title">Today's Attendance</h5>
                    </div>
                    <div class="box-body p-0">
                        <div class="media-list media-list-hover media-list-divided">
                            @foreach ($who_is_inside as $employee_inside)
                                <a class="media media-single" href="#">
                                    <span class="title">{{ $employee_inside->account->name }}</span>

                                    {{-- Start Time --}}
                                    <span class="badge badge-pill badge-info">ST:
                                        {{ date('H:i', strtotime($employee_inside->startTime)) }}</span>

                                    {{-- End Time --}}
                                    @if ($employee_inside->endTime != 'NaN')
                                        <span class="badge badge-pill badge-primary">ET:
                                            {{ date('H:i', strtotime($employee_inside->endTime)) }}</span>
                                    @endif

                                    {{-- Late --}}
                                    @if ($employee_inside->isLate > 0)
                                        <span class="badge badge-pill badge-danger">LATE</span>
                                    @endif

                                    {{-- Half day --}}
                                    @if ($employee_inside->isHalfDay > 0)
                                        <span class="badge badge-pill badge-warning">HALF DAY</span>
                                    @endif

                                    {{-- Over time --}}
                                    @if ($employee_inside->isOvertime > 0)
                                        <span class='badge badge-pill badge-purple'>OVERTIME</span>
                                    @endif

                                    @if ($employee_inside->atOffice < 1)
                                        <span class="badge badge-pill badge-info">REMOTE</span>
                                    @else
                                        <span class='badge badge-pill badge-warning'>OFFICE</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
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
    <!-- ./col --> --}}
    </div>

    {{-- <div class="row">
        @can('employees.insideoffice', Auth::user())
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h5 class="box-title">Today's Attendance</h5>
                    </div>
                    <div class="box-body p-0">
                        <div class="media-list media-list-hover media-list-divided">
                            @foreach ($who_is_inside as $employee_inside)
                                <a class="media media-single" href="#">
                                    <span class="title">{{ $employee_inside->account->name }}</span>

                                    {{-- Start Time -}}
                                    <span class="badge badge-pill badge-info">ST:
                                        {{ date('H:i', strtotime($employee_inside->startTime)) }}</span>

                                    {{-- End Time -}}
                                    @if ($employee_inside->endTime != 'NaN')
                                        <span class="badge badge-pill badge-primary">ET:
                                            {{ date('H:i', strtotime($employee_inside->endTime)) }}</span>
                                    @endif

                                    {{-- Late -}}
                                    @if ($employee_inside->isLate > 0)
                                        <span class="badge badge-pill badge-danger">LATE</span>
                                    @endif

                                    {{-- Half day -}}
                                    @if ($employee_inside->isHalfDay > 0)
                                        <span class="badge badge-pill badge-warning">HALF DAY</span>
                                    @endif

                                    {{-- Over time -}}
                                    @if ($employee_inside->isOvertime > 0)
                                        <span class='badge badge-pill badge-purple'>OVERTIME</span>
                                    @endif

                                    @if ($employee_inside->atOffice < 1)
                                        <span class="badge badge-pill badge-info">REMOTE</span>
                                    @else
                                        <span class='badge badge-pill badge-warning'>OFFICE</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div> --}}

@endsection
