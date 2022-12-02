@extends('backend.layouts.app')

@section('Page-Heading', 'Create a Report')

@section('backend_head')

    {{-- Select2 --}}
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor_components/select2/dist/css/select2.min.css') }}">

    {{-- Select2  --}}
    <link rel="stylesheet" href="{{ asset('backend/vendor_components/select2/dist/css/select2.min.css') }}">

    {{-- Theme style --}}
    <link rel="stylesheet" href="{{ asset('backend/css/master_style.css') }}">

@endsection

@section('content')

    <!-- Basic Forms -->
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Create a Report</h3>
                <!-- <h6 class="box-subtitle">Bootstrap Form Validation check the <a href="http://reactiveraven.github.io/jqBootstrapValidation/">official website </a></h6> -->

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if (Session::has('success_msg'))
                    <p class="alert alert-success fade-message">{{ Session::get('success_msg') }}</p>
                @elseif(Session::has('primary_msg'))
                    <p class="alert alert-primary fade-message">{{ Session::get('primary_msg') }}</p>
                @elseif(Session::has('error_msg'))
                    <p class="alert alert-danger fade-message">{{ Session::get('error_msg') }}</p>
                @endif
                <div class="row">
                    <div class="col">
                        <form action="{{ route('report.generate') }}">

                            <div class="form-group">
                                <label>Employee Name</label>
                                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                                    tabindex="-1" aria-hidden="true" name="employee">
                                    <option value="" selected="selected">Select Employee</option>
                                    @foreach ($getAccount as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>

                                @error('employee')
                                    <p class="validate">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Month</label>
                                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                                    tabindex="-1" aria-hidden="true" name="month">
                                    <option value="" selected="selected">Select Month</option>
                                    @foreach ($month as $m)
                                        <option value="{{ $loop->index + 1 }}">{{ $m }}</option>
                                    @endforeach
                                </select>

                                @error('month')
                                    <p class="validate">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>


                            {{-- <div class="form-group">
                                <div class="row">
                                    <div class="col">

                                        <div class="form-group">
                                            <label>Month</label>
                                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="user">
                                                <option selected="selected">Select Month</option>
                                                @foreach ($month as $m)
                                                    <option value="{{ $loop->index + 1 }}">{{ $m }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">

                                    </div>
                                </div>
                            </div> --}}


                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-info">Generate Report</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

@endsection

@section('scripts')

    <script src="{{ asset('backend/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>

    <script src="{{ asset('backend/js/pages/advanced-form-element.js') }}"></script>


@endsection
