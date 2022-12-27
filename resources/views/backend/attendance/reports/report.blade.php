@extends('backend.layouts.app')

@section('Page-Heading', 'Report')

@section('content')


    <div class="row">
        <div class="col-xl-4 col-lg-5">

            <!-- Profile Image -->
            <div class="box">
                <div class="box-body box-profile">
                    <img id="profileImageDisplay" class="profile-user-img rounded-circle img-fluid mx-auto d-block"
                        @if (request()->getHttpHost() == '127.0.0.1:8000') src="{{ asset($userPro->image) }}"
                    @else
                    src="{{ asset('storage/' . $userPro->image) }}" @endif />
                    <h3 class="profile-username text-center">{{ $userPro->name }}</h3>
                    <p class="text-muted text-center">{{ $userPro->profile->designation }}</p>

                    <div class="row">
                        <div class="col-12">
                            <p class="text-muted text-center">{{ $userPro->phone }}</p>

                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- /.col -->
        <div class="col-xl-8 col-lg-7">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">In the Month Of {{ $monthName }}</h3>
                    {{-- <h6 class="box-subtitle">Bootstrap Form Validation check the <a href="http://reactiveraven.github.io/jqBootstrapValidation/">official website </a></h6> --}}

                </div>
                {{-- /.box-header --}}
                <div class="box-body">
                    @if (Session::has('success-msg'))
                        <p class="alert alert-success fade-message">{{ Session::get('success-msg') }}</p>
                    @elseif(Session::has('primary_msg'))
                        <p class="alert alert-primary fade-message">{{ Session::get('primary_msg') }}</p>
                    @elseif(Session::has('error_msg'))
                        <p class="alert alert-danger fade-message">{{ Session::get('error_msg') }}</p>
                    @endif

                    <div class="row">
                        <!-- Column -->
                        <div class="col-md-6 col-lg-4 col-xlg-3">
                            <div class="box box-inverse box-info">
                                <div class="box-body text-center">
                                    <h1 class="font-light text-white">{{ $totalWorkingDays }}</h1>
                                    <h6 class="text-white mb-10">Working Days</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-4 col-xlg-3">
                            <div class="box box-success box-info">
                                <div class="box-body text-center">
                                    <h1 class="font-light text-white">{{ $totalPresentDays }}</h1>
                                    <h6 class="text-white mb-10">Present</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-4 col-xlg-3">
                            <div class="box box-inverse box-info">
                                <div class="box-body text-center">
                                    <h1 class="font-light text-white">{{ $totalAbsents }}</h1>
                                    <h6 class="text-white mb-10">Absents</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-4 col-xlg-3">
                            <div class="box box-inverse box-info">
                                <div class="box-body text-center">
                                    <h1 class="font-light text-white">{{ $totalHalfDays ?? 0 }}</h1>
                                    <h6 class="text-white mb-10">Half Days</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-4 col-xlg-3">
                            <div class="box box-inverse box-info">
                                <div class="box-body text-center">
                                    <h1 class="font-light text-white">{{ $totalLate ?? 0 }}</h1>
                                    <h6 class="text-white mb-10">Late Days</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-4 col-xlg-3">
                            <div class="box box-inverse box-info">
                                <div class="box-body text-center">
                                    <h1 class="font-light text-white">{{ $totalOvertimeDays }}</h1>
                                    <h6 class="text-white mb-10">Overtime Days</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-4 col-xlg-3">
                            <div class="box box-inverse box-info">
                                <div class="box-body text-center">
                                    <h1 class="font-light text-white">
                                        {{ number_format((float) $totalOvertime / 60, 1, '.', '') }}Hrs</h1>
                                    <h6 class="text-white mb-10">Overtime Hours</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- /.box-body --}}
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->


    <div class="row">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Present Days</h3>
                </div>
                <div class="box-body">
                    <table id="example"
                        class="table table-bordered table-hover display nowrap margin-top-10 table-responsive"
                        cellspacing="0" width="100%">
                        <thead style="background-color: #757ec8;">
                            <tr>
                                <th>Date</th>
                                <th>ST</th>
                                <th>ET</th>
                                <th>Late</th>
                                <th>HD</th>
                                <th>WH</th>
                                <th>OT</th>
                                <th>Where</th>
                            </tr>
                        </thead>
                        <tfoot style="background-color: #757ec8;">
                            <tr>
                                <th>Date</th>
                                <th>ST</th>
                                <th>ET</th>
                                <th>Late</th>
                                <th>HD</th>
                                <th>WH</th>
                                <th>OT</th>
                                <th>Where</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($getAttendance as $detail)
                                <tr>
                                    <td>{{ $detail->day }}/{{ $detail->month }}</td>
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
                                    <td>{{ number_format((float) $detail->workingHours / 60, 1, '.', '') }}
                                        Hrs
                                    </td>
                                    <td>
                                        @if ($detail->isOvertime > 0)
                                            <span class='badge badge-pill badge-brown'
                                                title="{{ number_format((float) $detail->over_time / 60, 1, '.', '') }} hrs">OVERTIME</span>
                                        @else
                                            NO
                                        @endif
                                    </td>
                                    <td>
                                        @if ($detail->atOffice < 1)
                                            <span class="badge badge-pill badge-info">REMOTE</span>
                                        @else
                                            <span class='badge badge-pill badge-warning'>OFFICE</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Days Without Check-Out</h3>
                </div>
                <div class="box-body">
                    <table id="example"
                        class="table table-bordered table-hover display nowrap margin-top-10 table-responsive"
                        cellspacing="0" width="100%">
                        <thead style="background-color: #757ec8;">
                            <tr>
                                <th>Date</th>
                                <th>ST</th>
                                <th>Late</th>
                                <th>Where</th>
                            </tr>
                        </thead>
                        <tfoot style="background-color: #757ec8;">
                            <tr>
                                <th>Date</th>
                                <th>ST</th>
                                <th>Late</th>
                                <th>Where</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($getAttendanceWithoutCheckout as $detail)
                                <tr>
                                    <td>{{ $detail->day }}/{{ $detail->month }}</td>
                                    <td>{{ date('H:i', strtotime($detail->startTime)) }}</td>

                                    <td>
                                        @if ($detail->isLate > 0)
                                            <span class="label label-danger">LATE</span>
                                        @else
                                            NO
                                        @endif
                                    </td>
                                    <td>
                                        @if ($detail->atOffice < 1)
                                            <span class="badge badge-pill badge-info">REMOTE</span>
                                        @else
                                            <span class='badge badge-pill badge-warning'>OFFICE</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    @include('backend.layouts.datatables')
@endsection
