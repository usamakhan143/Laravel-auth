@extends('backend.layouts.app')

@section('Page-Heading', 'Pending Profiles')

@section('content')

    @if (Session::has('success_msg'))
        <p class="alert alert-success fade-message">{{ Session::get('success_msg') }}</p>
    @elseif(Session::has('primary_msg'))
        <p class="alert alert-primary fade-message">{{ Session::get('primary_msg') }}</p>
    @elseif(Session::has('error_msg'))
        <p class="alert alert-danger fade-message">{{ Session::get('error_msg') }}</p>
    @endif


    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">All Details</h3>
            <!--<h6 class="box-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>-->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive"
                cellspacing="0" width="100%">
                <thead style="background-color: #757ec8">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        @can('profile.activate', Auth::user())
                            <th>Action</th>
                        @endcan
                    </tr>
                </thead>
                <tfoot style="background-color: #757ec8">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        @can('profile.activate', Auth::user())
                            <th>Action</th>
                        @endcan
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($all_profiles as $detail)
                        <tr>
                            <td>{{ $detail->account->name }}</td>
                            <td>{{ $detail->account->email }}</td>
                            <td>{{ $detail->account->phone }}</td>
                            {{-- <td>
                                @if ($detail->status == 1)
                                    <span class="label" style="background-color: green">ON</span>
                                @else
                                    <span class="label" style="background-color: red">OFF</span>
                                @endif
                            </td> --}}
                            <td>
                                @if ($detail->account->cnic != null && $detail->account->cnic->status == 1)
                                    @can('profile.activate', Auth::user())
                                        <a href="{{ route('actv.profile', $detail->id) }}" class="btn btn-danger btn-xs"
                                            onclick="return confirm('Are you sure you want to activate this Profile?');">
                                            <i class="fa fa-edit"></i> Activate now
                                        </a>
                                    @endcan
                                    @can('reports.singlepageuserattend', Auth::user())
                                        <a href="{{ route('show.account', $detail->account_id) }}"
                                            class="btn btn-success btn-xs">
                                            <i class="fa fa-edit"></i> View
                                        </a>
                                        <a href="{{ route('idcard.reupload', $detail->account->cnic->id) }}"
                                            class="btn btn-info btn-xs"
                                            onclick="return confirm('Are you sure you want to send the re-upload request?');">
                                            <i class="fa fa-refresh"></i> Re Upload
                                        </a>
                                    @endcan
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->


@endsection

@section('scripts')
    @include('backend.layouts.datatables')
@endsection
