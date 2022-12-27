@extends('backend.layouts.app')

@section('Page-Heading', 'All Holidays')

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
							<a href="{{ route('holiday.create') }}" class="btn btn-danger">Add new</a>
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
						<th style="width: 600px">Description</th>
						<th style="width: 100px">Date</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tfoot style="background-color: #757ec8">
					<tr>
						<th>Name</th>
						<th style="width: 600px">Description</th>
						<th style="width: 100px">Date</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</tfoot>
				<tbody>
					@foreach($all_holidays as $detail)
						<tr>
							<td>{{ $detail->name }}</td>
							<td>{{ $detail->description }}</td>
							<td>{{ $detail->day }}/{{ $detail->month }}/{{ $detail->year }}</td>
							<td>
								@if($detail->status == 1)
									<span class="label" style="background-color: green">ON</span>
								@else
									<span class="label" style="background-color: red">OFF</span>
								@endif
							</td>
							<td>
								@can('Holiday.edit', Auth::user())
									<a href="{{ route('holiday.edit', $detail->id) }}" class="btn btn-success btn-xs">
						                <i class="fa fa-edit"></i> Edit
						            </a>
						        @endcan

						        @can('Holiday.delete', Auth::user())
					            	<a href="{{ route('holiday.destroy', $detail->id) }}" class="btn btn-danger btn-xs" onclick = "return confirm('Are you sure you want to delete this holiday?');">
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