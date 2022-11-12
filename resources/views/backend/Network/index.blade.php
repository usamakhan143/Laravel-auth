@extends('backend.layouts.app')

@section('Page-Heading', 'Network Details')

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
            <div class="row pr-10">
                <div class="col-md-11">
                    <h3 class="box-title">All Details</h3>
                </div>
                <div class="col-md-1">
                    @can('networks.create', Auth::user())
                        <a href="{{ route('network.create') }}" class="btn btn-danger">Add new</a>
                    @endcan
                </div>
            </div>
            {{-- <h6 class="box-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
        </div>
        {{-- box-header  --}}
        <div class="box-body">
            <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive"
                cellspacing="0" width="100%">
                <thead style="background-color: #757ec8">
                    <tr>
                        <th>S.NO</th>
                        <th style="width: 600px">Name</th>
                        <th style="width: 600px">IP</th>
                        <th style="width: 600px">MAC</th>
                        <th style="width: 600px">Users</th>
                        <th style="width: 600px">status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot style="background-color: #757ec8">
                    <tr>
                        <th>S.NO</th>
                        <th style="width: 600px">Name</th>
                        <th style="width: 600px">IP</th>
                        <th style="width: 600px">MAC</th>
                        <th style="width: 600px">Users</th>
                        <th style="width: 600px">status</th>
                        @can('networks.update', Auth::user())
                            <th>Action</th>
                        @endcan
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($nw as $detail)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $detail->name }}</td>
                            <td>{{ $detail->ip }}</td>
                            <td>{{ $detail->mac }}</td>
                            <td>{{ $detail->account->name }}</td>
                            <td>
                                @if ($detail->status == 1)
                                    <span class="label" style="background-color: green">ON</span>
                                @else
                                    <span class="label" style="background-color: red">OFF</span>
                                @endif
                            </td>
                            @can('networks.update', Auth::user())
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('network.edit', $detail->id) }}" class="btn btn-success">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>&nbsp;
                                        @can('networks.delete', Auth::user())
                                            <a href="{{ route('del.network', $detail->id) }}" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this Network?');">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                        @endcan
                                        {{-- @can('networks.delete', Auth::user())
						            	<form method="post" action="{{ route('networks.destroy', $detail->id) }}" onclick = "return confirm('Are you sure you want to delete this Role?');">
					                    	@csrf
					                    	@method('DELETE')
					                    	<button type="submit" class="btn btn-danger">Delete</button>
					                	</form>
					                @endcan --}}
                                    </div>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
        {{-- box-body --}}
    </div>
    {{-- box --}}


@endsection

@section('scripts')
    @include('backend.layouts.datatables')
@endsection
