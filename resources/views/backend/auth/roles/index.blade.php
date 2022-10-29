@extends('backend.layouts.app')

@section('Page-Heading', 'Roles Details')

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
              {{-- <h6 class="box-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
            </div>
            {{-- box-header  --}}
            <div class="box-body">
              <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive" cellspacing="0" width="100%">
				<thead style="background-color: #757ec8">
					<tr>
						<th>S.NO</th>
						<th style="width: 600px">Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tfoot style="background-color: #757ec8">
					<tr>
						<th>S.NO</th>
						<th style="width: 600px">Name</th>
						<th>Action</th>
					</tr>
				</tfoot>
				<tbody>
					@foreach($roles as $detail)
						<tr>
							<td>{{ $loop->index + 1 }}</td>
							<td>{{ $detail->name }}</td>
							<td>
								<div class="btn-group" role="group" aria-label="Basic example">
									@can('roles.update', Auth::user())
										<a href="{{ route('role.edit', $detail->id) }}" class="btn btn-success">
						                	<i class="fa fa-edit"></i> Edit
						            	</a>&nbsp;
						            @endcan
									@can('roles.delete', Auth::user())
										<a href="{{ route('del.role', $detail->id) }}" class="btn btn-danger" onclick = "return confirm('Are you sure you want to delete this Role?');">
											<i class="fa fa-trash"></i> Delete
										</a>
									@endcan
						            {{-- @can('roles.delete', Auth::user())
						            	<form method="post" action="{{ route('roles.destroy', $detail->id) }}" onclick = "return confirm('Are you sure you want to delete this Role?');">
					                    	@csrf
					                    	@method('DELETE')
					                    	<button type="submit" class="btn btn-danger">Delete</button>
					                	</form>
					                @endcan --}}
					            </div>
							</td>
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