@extends('backend.layouts.app')

@section('Page-Heading', 'Users Details')

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
                        <th>Assigned Roles</th>
                        <th>Status</th>
                        @can('accounts.update', Auth::user())
                            <th>Action</th>
                        @endcan
                    </tr>
                </thead>
                <tfoot style="background-color: #757ec8">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Assigned Roles</th>
                        <th>Status</th>
                        @can('accounts.update', Auth::user())
                            <th>Action</th>
                        @endcan
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($accounts as $detail)
                        <tr @can('reports.singlepageuserattend', Auth::user())data-href="{{ route('show.account', $detail->id) }}"@endcan>
                            <td><a class="avatar avatar-lg" href="#">
                                <img @if (request()->getHttpHost() == '127.0.0.1:8000') src="{{ asset($detail->image) }}"
                                @else
                                src="{{ asset('storage/' . $detail->image) }}" @endif alt="Profile Picture">
                              </a> {{ $detail->name }}
                            </td>
                            <td>{{ $detail->email }}</td>
                            <td>{{ $detail->phone }}</td>
                            <td>
                                @foreach ($detail->roles as $assignRoles)
                                    <span class="label" style="background-color: darkblue">{{ $assignRoles->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if ($detail->status == 1)
                                    <span class="label" style="background-color: green">ON</span>
                                @else
                                    <span class="label" style="background-color: red">OFF</span>
                                @endif
                            </td>
                            @can('accounts.update', Auth::user())
                                <td>
                                    {{-- <a href="{{ route('show.account', $detail->id) }}"
                                        class="btn btn-block btn-primary btn-xs">
                                        <i class="fa fa-edit"></i> Show
                                    </a> --}}

                                    <a href="{{ route('accounts.edit', $detail->id) }}"
                                        class="btn btn-social-icon btn-bitbucket">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    @can('accounts.delete', Auth::user())
                                        <a href="{{ route('accountDestroy', $detail->id) }}" class="btn btn-social-icon btn-foursquare"
                                            onclick="return confirm('Are you sure you want to delete this account?');">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    @endcan
                                </td>
                            @endcan
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
