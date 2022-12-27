@extends('backend.layouts.app')

@section('Page-Heading', $getAccount->name . "'s Details")

@section('content')

    <section class="content">

        <div class="row">
            <div class="col-xl-4 col-lg-5">

                <!-- Profile Image -->
                <div class="box">
                    <div class="box-body box-profile">
                        <img id="profileImageDisplay" class="profile-user-img rounded-circle img-fluid mx-auto d-block"
                            @if (request()->getHttpHost() == '127.0.0.1:8000') src="{{ asset($getAccount->image) }}"
                    @else
                    src="{{ asset('storage/' . $getAccount->image) }}" @endif />
                        <h3 class="profile-username text-center">{{ $getAccount->name }}</h3>
                        <p class="text-muted text-center">{{ $getAccount->profile->designation }}</p>

                        <div class="row">
                            <div class="col-12">
                                <div class="profile-user-info">
                                    <b>
                                        <p>Email address:</p>
                                    </b>
                                    <h6 class="margin-bottom">{{ $getAccount->email }}</h6>
                                    <b>
                                        <p>Phone:</p>
                                    </b>
                                    <h6 class="margin-bottom">{{ $getAccount->phone }}</h6>
                                    @if ($getAccount->id != 16 && $getAccount->id != 19)
                                        <b>
                                            <p>Hired on:</p>
                                        </b>
                                        <h6 class="margin-bottom">{{ $getAccount->profile->hireDate }}</h6>
                                    @endif
                                    @if ($getAccount->status > 0)
                                        <b>
                                            <p>C-NIC:</p>
                                        </b>
                                        <h6 class="margin-bottom">{{ $getAccount->profile->identityNumber }}</h6>
                                        <b>
                                            <p>Gender:</p>
                                        </b>
                                        <h6 class="margin-bottom">{{ $getAccount->profile->gender }}</h6>
                                    @endif
                                    @can('profile.Idcard', Auth::user())
                                        @if ($getAccount->cnic != null)
                                            <b>
                                                <p>Identity Card:</p>
                                            </b>
                                            <a href="{{ asset('storage/' . $getAccount->cnic->pic_1) }}" target="_blank"><img
                                                    @if (request()->getHttpHost() == '127.0.0.1:8000') src="{{ asset('storage/' . $getAccount->cnic->pic_1) }}"
                                            @else
                                                src="{{ asset('storage/' . $getAccount->cnic->pic_1) }}" @endif />
                                            </a><br /><br />
                                            <a href="{{ asset('storage/' . $getAccount->cnic->pic_2) }}" target="_blank"><img
                                                    @if (request()->getHttpHost() == '127.0.0.1:8000') src="{{ asset('storage/' . $getAccount->cnic->pic_2) }}"
                                            @else
                                                src="{{ asset('storage/' . $getAccount->cnic->pic_2) }}" @endif />
                                            </a>
                                        @endif
                                    @endcan
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- /.col -->
            <div class="col-xl-8 col-lg-7">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Month of {{ date('M') }} Attendance</h3>
                        {{-- <h6 class="box-subtitle">Bootstrap Form Validation check the <a href="http://reactiveraven.github.io/jqBootstrapValidation/">official website </a></h6> --}}

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
                                @foreach ($getAttendance as $detail)
                                    <tr>
                                        <td>{{ $detail->day }}</td>
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
                                        <td>{{ number_format((float) $detail->workingHours / 60, 1, '.', '') }} Hrs
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
                            <div class="col">
                                <form action="{{ route('att.range.account', $getAccount->id) }}">

                                    <div class="form-group">
                                        <h5>From <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="from_date" class="form-control"
                                                value="{{ old('from_date') }}" />
                                        </div>
                                        @error('from-date')
                                            <p class="validate">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>To <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="to_date" class="form-control"
                                                value="{{ old('to_date') }}" />
                                        </div>
                                        @error('to-date')
                                            <p class="validate">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="text-xs-right">
                                        <button type="submit" class="btn btn-info">Check</button>
                                    </div>
                                </form>

                            </div>

                            {{-- /.col --}}
                        </div>
                        {{-- /.row --}}
                        <div class="row">
                            <div class="col">
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
                                            @forelse($get_Atte as $detail)
                                                <tr>
                                                    <td>{{ $detail->day }}</td>
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
                                            @empty
                                                <tr>
                                                    <span class="bg-danger text-white p-1">No Attendance</span>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>


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

    </section>

@endsection

@section('scripts')
    @include('backend.layouts.datatables')
@endsection
