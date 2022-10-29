@extends('backend.layouts.app')

@section('Page-Heading', 'All Shifts')

@section('content')

	@if(Session::has('success_msg'))
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
						@can('shift.create', Auth::user())
							<a href="{{ route('shift.create') }}" class="btn btn-danger">Add new</a>
						@endcan
					</div>
				</div>
				{{-- <h6 class="box-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
            </div>
            {{-- /.box-header --}}
            <div class="box-body">
              <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive" cellspacing="0" width="100%">
				<thead style="background-color: #757ec8">
					<tr>
						<th>Name</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Total Hours</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tfoot style="background-color: #757ec8">
					<tr>
						<th>Name</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Total Hours</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</tfoot>
				<tbody>
					@foreach($get_all_shifts as $detail)
						<tr>
							<td>{{ $detail->name }}</td>
							<td>{{ $detail->start_time }}</td>
							<td>{{ $detail->end_time }}</td>
							<td>{{ $detail->working_hours }} hours</td>
							<td>
								@if($detail->status == 1)
									<span class="label" style="background-color: green">ON</span>
								@else
									<span class="label" style="background-color: red">OFF</span>
								@endif
							</td>
							<td>
								@can('shift.update', Auth::user())
									<a href="{{ route('shift.edit', $detail->id) }}" class="btn btn-success btn-xs">
						                <i class="fa fa-edit"></i> Edit
						            </a>
						        @endcan

						        @can('shift.delete', Auth::user())
					            	<a href="{{ route('shift.destroy', $detail->id) }}" class="btn btn-danger btn-xs" onclick = "return confirm('Are you sure you want to delete this shift?');">
					                	<i class="fa fa-trash"></i> Delete
					            	</a>
					            @endcan
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