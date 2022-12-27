@extends('backend.layouts.app')

@section('Page-Heading', 'Profile')

@section('backend_head')

    <link href="{{ asset('backend/css/lightbox.min.css') }}" rel="stylesheet" />

@endsection

@section('content')

    <section class="content">

        <div class="row">
            <div class="col-xl-4 col-lg-5">

                {{-- Profile Image --}}
                <div class="box">
                    <div class="box-body box-profile">
                        <img id="profileImageDisplay" class="profile-user-img rounded-circle img-fluid mx-auto d-block"
                            @if (request()->getHttpHost() == '127.0.0.1:8000') src="{{ asset(Auth::guard('account')->user()->image) }}"
                        @else
                        src="{{ asset('storage/' . Auth::guard('account')->user()->image) }}" @endif />
                        <h3 class="profile-username text-center">{{ Auth::guard('account')->user()->name }}</h3>
                        <p class="text-muted text-center">{{ Auth::guard('account')->user()->profile->designation }}</p>

                        <div class="row">
                            <div class="col-12">
                                <div class="profile-user-info">
                                    <b>
                                        <p>Email address:</p>
                                    </b>
                                    <h6 class="margin-bottom">{{ Auth::guard('account')->user()->email }}</h6>
                                    <b>
                                        <p>Phone:</p>
                                    </b>
                                    <h6 class="margin-bottom">{{ Auth::guard('account')->user()->phone }}</h6>
                                    @if (Auth::guard('account')->user()->id != 16 && Auth::guard('account')->user()->id != 19)
                                        <b>
                                            <p>Hired on:</p>
                                        </b>
                                        <h6 class="margin-bottom">{{ $get_Profile->hireDate }}</h6>
                                    @endif
                                    @if ($get_Profile->status > 0)
                                        <b>
                                            <p>C-NIC:</p>
                                        </b>
                                        <h6 class="margin-bottom">{{ $get_Profile->identityNumber }}</h6>
                                        <b>
                                            <p>Gender:</p>
                                        </b>
                                        <h6 class="margin-bottom">{{ $get_Profile->gender }}</h6>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            {{-- /.col --}}
            <div class="col-xl-8 col-lg-7">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Profile</h3>
                        {{-- <h6 class="box-subtitle">Bootstrap Form Validation check the <a href="http://reactiveraven.github.io/jqBootstrapValidation/">official website </a></h6> --}}

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

                        @if (Auth::guard('account')->user()->cnic == null && Auth::guard('account')->user()->profile->status == 0)
                        @elseif(Auth::guard('account')->user()->cnic != null &&
                            Auth::guard('account')->user()->cnic->status == 0 &&
                            Auth::guard('account')->user()->profile->status == 0)
                            <div class="callout callout-danger">
                                <h4>Sorry!</h4>
                                We are unable to verify your Identity please re-upload your ID Card back & Front photocopy
                                and please make sure that everything in the picture should be clearly visible.
                            </div>
                        @elseif (Auth::guard('account')->user()->cnic != null &&
                            Auth::guard('account')->user()->cnic->status == 1 &&
                            Auth::guard('account')->user()->profile->status == 0)
                            <div class="callout callout-info">
                                <h4>Please Wait!</h4>
                                We are verifying your Identity keep patients we will approve your profile with in 24hrs.
                            </div>
                        @else
                        @endif

                        <div class="row">
                            <div class="col">
                                <form action="{{ route('update.profile', Auth::guard('account')->user()->id) }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    @can('profile.activate', Auth::user())
                                        @if (Auth::guard('account')->user()->cnic == null ||
                                            (Auth::guard('account')->user()->cnic->status == 0 && Auth::guard('account')->user()->profile->status == 0))
                                            <div class="form-group">
                                                <h5>CNIC Number <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="nic" class="form-control"
                                                        placeholder="Ex. 42XXX-XXXXXXXXX-X" />
                                                </div>
                                                @error('nic')
                                                    <p class="validate">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <h5>CNIC Front & Back <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="id-picture[]" class="form-control" multiple />
                                                </div>
                                                <div class="form-control-feedback">
                                                    <small>Please select two photocopy images of your Identity card Front and Back in this field. Only two images are required.</small>
                                                </div>
                                                @error('id-picture')
                                                    <p class="validate">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <h5>Gender <span class="text-danger">*</span></h5>
                                                <div class="demo-radio-button">
                                                    <input name="gender" type="radio" id="radio_1" value="Male">
                                                    <label for="radio_1">Male</label>
                                                    <input name="gender" type="radio" id="radio_2" value="Female">
                                                    <label for="radio_2">Female</label>
                                                </div>
                                                @error('gender')
                                                    <p class="validate">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                        @endif
                                    @endcan

                                    <div class="form-group">
                                        <h5>Profile Picture</h5>
                                        <div class="controls">
                                            <input type="file" id="getProfileImage" name="profileImage"
                                                class="form-control" />
                                        </div>
                                        @error('profileImage')
                                            <p class="validate">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="text-xs-right">
                                        <button type="submit" class="btn btn-info">
                                            @if (Auth::guard('account')->user()->cnic == null || Auth::guard('account')->user()->cnic->status == 0)
                                                Activate
                                            @else
                                                Update
                                            @endif
                                        </button>
                                    </div>
                                </form>

                            </div>

                            {{-- /.col --}}
                        </div>
                        {{-- /.row --}}
                    </div>
                    {{-- /.box-body --}}
                </div>
                {{-- /.nav-tabs-custom --}}
            </div>
            {{-- /.col --}}
        </div>
        {{-- /.row --}}

    </section>

@endsection


@section('scripts')
    <script src="{{ asset('backend/js/lightbox-plus-jquery.min.js') }}"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#profileImageDisplay').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#getProfileImage").change(function() {
            readURL(this);
        });
    </script>

@endsection
