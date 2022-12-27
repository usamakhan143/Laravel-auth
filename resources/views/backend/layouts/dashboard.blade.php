@extends('backend.layouts.app')

@section('Page-Heading', 'Dashboard')

@section('content')

    <div class="row">

        @can('employees', Auth::user())
            <div class="col-xl-3 col-md-6 col-12 ">
                <a href="{{ route('all.accounts') }}" style="color: white">
                    <div class="box box-body bg-info">
                        <div class="flexbox">
                            <span class="ion ion-ios-person-outline font-size-50"></span>
                            <span class="font-size-40 font-weight-200">{{ $numbers_of_emp }}</span>
                        </div>
                        <div class="text-right">Employees</div>
                    </div>
                </a>
            </div>
            <!-- /.col -->
            <div class="col-xl-3 col-md-6 col-12 ">
                <a href="{{ route('report.allatt') }}" style="color: white">
                    <div class="box box-body bg-info">
                        <div class="flexbox">
                            <span class="ti-check-box font-size-40"></span>
                            <span class="font-size-40 font-weight-200">{{ $total_present }} / {{ $numbers_of_emp }}</span>
                        </div>
                        <div class="text-right">Total Present</div>
                    </div>
                </a>
            </div>
        @endcan
        @can('pending.profiles', Auth::user())
            @if ($pending_Profiles != 0)
                <div class="col-xl-3 col-md-6 col-12 ">
                    <a href="{{ route('pend.profile') }}" style="color: white">
                        <div class="box box-body bg-info">
                            <div class="flexbox">
                                <i class="ti-alert" style="font-size:50px" aria-hidden="true"></i>
                                <span class="font-size-40 font-weight-200">{{ $pending_Profiles }}</span>
                            </div>
                            <div class="text-right">Pending Accounts</div>
                        </div>
                    </a>
                </div>
            @endif
        @endcan
    </div>

    {{-- <div class="row">
        @include('backend.partials.quickattendance')
    </div> --}}

    <div class="row">

        @can('employees.insideoffice', Auth::user())
            <div class="col-md-12">
                @if ($check_record > 0)
                    <div class="box">
                        <div class="box-header with-border">
                            <h5 class="box-title">Today's Attendance</h5>
                        </div>
                        <div class="box-body p-0">
                            <div class="media-list media-list-hover media-list-divided">
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($who_is_inside as $employee_inside)
                                    <div class="col-md-6">
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
                                                <span class='badge badge-pill badge-purple'
                                                    title="{{ number_format((float) $employee_inside->over_time / 60, 1, '.', '') }}hrs">OVERTIME</span>
                                            @endif
    
                                            @if ($employee_inside->atOffice < 1)
                                                <span class="badge badge-pill badge-info">REMOTE</span>
                                            @else
                                                <span class='badge badge-pill badge-warning'>OFFICE</span>
                                            @endif
                                        </a>
                                    </div>
                                    @if (++$i == 6)
                                        <?php break; ?>
                                    @endif
                                @endforeach
                                {{-- @foreach ($who_is_inside as $employee_inside)
                                    
                                @endforeach --}}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endcan
    </div>

    @if (Auth::guard('account')->user()->id != 1)
        <div class="row">
            <div class="col-xl-3 col-md-6 col">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="ti-alarm-clock"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-number">{{ Auth::guard('account')->user()->shifts[0]->name }}</span>
                        <span class="info-box-text">My Shift</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

        </div>
    @endif
@endsection
