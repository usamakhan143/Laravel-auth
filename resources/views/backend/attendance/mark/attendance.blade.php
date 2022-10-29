@extends('backend.layouts.app')

@section('Page-Heading', 'Mark Your Attendance')

@section('content')



    @if (Session::has('success_msg'))
        <p class="alert alert-success fade-message">{{ Session::get('success_msg') }}</p>
    @elseif(Session::has('primary_msg'))
        <p class="alert alert-primary fade-message">{{ Session::get('primary_msg') }}</p>
    @elseif(Session::has('error_msg'))
        <p class="alert alert-danger fade-message">{{ Session::get('error_msg') }}</p>
    @endif
    <div class="container">

        @if (Auth::guard('account')->user()->profile->status > 0)
            <div class="row">
                <div class="col-md-4">
                    @if ($check_Is_marked == null)
                        @if ($officeStatus > 0)
                            @if ($checkIP == true)
                                <div class="info-box">
                                    <a href="{{ route('mark.instore') }}"><span class="info-box-icon bg-info"><i
                                                class="fa fa-sign-in"></i></span></a>
                                    <div class="info-box-content">
                                        <span class="info-box-number">Check IN<small></small></span>
                                        <span class="info-box-text"><b>I am in Office</b></span>
                                    </div>
                                </div>
                            @else
                                <div class="container">
                                    <p><b>Oops! I think you are not currently inside office</b></p>
                                </div>
                            @endif
                        @else
                            <div class="info-box">
                                <a href="{{ route('mark.instore') }}"><span class="info-box-icon bg-orange"><i
                                            class="fa fa-sign-in"></i></span></a>
                                <div class="info-box-content">
                                    <span class="info-box-number">Check IN<small></small></span>
                                    <span class="info-box-text"><b>I am on Remote</b></span>
                                </div>
                            </div>
                        @endif
                    @else
                        @if ($get_out_status < 1)
                            @if ($checkIP == true)
                                <div class="info-box">
                                    <a href="{{ route('mark.outstore') }}"><span class="info-box-icon bg-danger"><i
                                                class="fa fa-sign-out"></i></span></a>
                                    <div class="info-box-content">
                                        <span class="info-box-number">Check OUT<small></small></span>
                                        <span class="info-box-text"><b>I am Signing Off now</b></span>
                                    </div>
                                </div>
                            @else
                                <p><b>Oops! I think you are not currently inside office</b></p>
                            @endif
                        @else
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fa fa-thumbs-up"></i></span></a>
                                <div class="info-box-content">
                                    <span class="info-box-number">Good Bye!<small></small></span>
                                    <span class="info-box-text"><b>Have a great day</b></span>
                                </div>
                            </div>
                        @endif
                    @endif

                    @if ($get_my_attendance != null)
                        <div class="box">
                            <div class="box-header with-border">
                                <h5 class="box-title">Today's Attendance</h5>
                            </div>
                            <div class="box-body p-0">
                                <div class="media-list media-list-hover media-list-divided">
                                    <a class="media media-single" href="#">
                                        <span class="title">Start Time</span>
                                        <span
                                            class="badge badge-pill badge-primary">{{ date('H:i', strtotime($get_my_attendance->startTime)) }}</span>
                                    </a>

                                    <a class="media media-single" href="#">
                                        <span class="title">End Time</span>
                                        <span class="badge badge-pill badge-info">
                                            @if ($get_my_attendance->endTime != 'NaN')
                                                {{ date('H:i', strtotime($get_my_attendance->endTime)) }}
                                            @else
                                                NaN
                                            @endif
                                        </span>
                                    </a>

                                    <a class="media media-single" href="#">
                                        <span class="title">Late</span>
                                        <span class="badge badge-pill badge-danger">

                                            {{ $get_my_attendance->isLate < 1 ? 'ON TIME' : 'YES' }}

                                        </span>
                                    </a>

                                    <a class="media media-single" href="#">
                                        <span class="title">Working From</span>
                                        <span class="badge badge-pill badge-warning">
                                            {{ $get_my_attendance->atOffice > 0 ? 'Office' : 'Remote' }}
                                        </span>
                                    </a>

                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-8">


                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">My Attendance</h3>
                            {{-- <h6 class="box-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
                        </div>

                        <div class="box-body">
                            <table id="example"
                                class="table table-bordered table-hover display nowrap margin-top-10 table-responsive"
                                cellspacing="0" width="100%">
                                <thead style="background-color: #757ec8;">
                                    <tr>
                                        <th>ST</th>
                                        <th>ET</th>
                                        <th>Late</th>
                                        <th>HD</th>
                                        <th>WH</th>
                                        <th>OT</th>
                                        <th>Where</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tfoot style="background-color: #757ec8;">
                                    <tr>
                                        <th>ST</th>
                                        <th>ET</th>
                                        <th>Late</th>
                                        <th>HD</th>
                                        <th>WH</th>
                                        <th>OT</th>
                                        <th>Where</th>
                                        <th>Date</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($get_my_all_attendance as $detail)
                                        <tr>
                                            <td>{{ date('H:i', strtotime($detail->startTime)) }}</td>
                                            <td>
                                                @if ($detail->endTime != 'NaN')
                                                    {{ date('H:i', strtotime($detail->endTime)) }}
                                                @else
                                                    NaN
                                                @endif

                                            </td>
                                            <td>
                                                @if ($detail->isLate > 0)
                                                    <span class="label label-danger">LATE</span>
                                                @else
                                                    NO
                                                @endif
                                            </td>
                                            <td>
                                                @if ($detail->isHalfDay > 0)
                                                    <span class="label label-danger">HALF DAY</span>
                                                @else
                                                    NO
                                                @endif
                                            </td>
                                            <td>{{ number_format((float) $detail->workingHours / 60, 0, '.', '') }} Hours
                                            </td>
                                            <td>
                                                @if ($detail->isOvertime < 1)
                                                    NO
                                                @else
                                                    <span class='badge badge-pill badge-green'>OVERTIME</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($detail->atOffice < 1)
                                                    <span class="badge badge-pill badge-info">REMOTE</span>
                                                @else
                                                    <span class='badge badge-pill badge-warning'>OFFICE</span>
                                                @endif
                                            </td>
                                            <td>{{ $detail->day }}/{{ $detail->month }}/{{ $detail->year }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                        </div>

                    </div>

                </div>
            </div>
        @else
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        {{-- <h4 class="box-title">Alert</h4> --}}
                    </div>
                    <div class="box-body">
                        <div class="media flex-column text-center p-40">
                            <span class="avatar avatar-lg bg-danger opacity-60 mx-auto">
                                <i class="fa fa-exclamation-triangle fa-lg"></i>
                            </span>
                            <div class="mt-20">
                                <h3 class="text-uppercase fw-500">Alert</h3>
                                <p>PLease activate your profile first!!!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    @endsection

    @section('scripts')
        @include('backend.layouts.datatables')
    @endsection
