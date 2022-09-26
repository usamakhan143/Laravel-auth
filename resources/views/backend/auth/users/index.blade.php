@extends('backend.layouts.app')

@section('Page-Heading', 'Users Details')

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
              <h3 class="box-title">All Details</h3>
              <!--<h6 class="box-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive" cellspacing="0" width="100%">
				<thead style="background-color: #3644AF">
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Assigned Roles</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tfoot style="background-color: #3644AF">
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Assigned Roles</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</tfoot>
				<tbody>
					@foreach($accounts as $detail)
						<tr>
							<td>{{ $detail->name }}</td>
							<td>{{ $detail->email }}</td>
							<td>{{ $detail->phone }}</td>
							<td>
								@foreach($detail->roles as $assignRoles)
									<span class="label" style="background-color: darkblue">{{ $assignRoles->name }}</span>
								@endforeach
							</td>
							<td>
								@if($detail->status == 1)
									<span class="label" style="background-color: green">ON</span>
								@else
									<span class="label" style="background-color: red">OFF</span>
								@endif
							</td>
							<td>
								@can('accounts.update', Auth::user())
									<a href="{{ route('accounts.edit', $detail->id) }}" class="btn btn-block btn-success btn-xs">
						                <i class="fa fa-edit"></i> Edit
						            </a>
						        @endcan

						        @can('accounts.delete', Auth::user())
					            	<a href="{{ route('accountDestroy', $detail->id) }}" class="btn btn-block btn-danger btn-xs" onclick = "return confirm('Are you sure you want to delete this account?');">
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