@extends('backend.layouts.app')

@section('Page-Heading', 'In the Month Off ' . date('M'))

@section('content')

    <div class="row">
        <div class="col">
            <div class="box">
                <div class="box-body">
                    <table id="example"
                        class="table table-bordered table-hover display nowrap margin-top-10 table-responsive" cellspacing="0"
                        width="100%">
                        <thead style="background-color: #757ec8;">
                            <tr>
                                <th>Name</th>
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
                                <th>Name</th>
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
                            @forelse($getAttendance as $detail)
                                <tr>
                                    <td>{{ $detail->account->name }}</td>
                                    <td>{{ $detail->day }}/{{ $detail->month }}/{{ $detail->year }}</td>
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

@endsection


@section('scripts')
    @include('backend.layouts.datatables')
@endsection
