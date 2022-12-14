<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('dashboard.home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <b class="logo-mini">
            <span class="light-logo"><img src="{{ asset('backend/images/logo-dark.png') }}" alt="logo"></span>
            <span class="dark-logo"><img src="{{ asset('backend/images/logo-dark.png') }}" alt="logo"></span>
        </b>
        <!-- logo for regular state and mobile devices -->
        <style type="text/css">
            @media screen and (max-width: 766px) {
                .light-logo {
                    width: 200px;
                }
            }

            .bar {
                float: left;
                background-color: transparent;
                background-image: none;
                padding: 20px;
                font-family: fontAwesome;
                color: #3644AF;
            }
        </style>
        <span class="logo-lg">
            <img src="{{ asset('backend/images/logo-dark-text.png') }}" alt="logo" class="light-logo">
            <img src="{{ asset('backend/images/logo-dark-text.png') }}" alt="logo" class="dark-logo">
        </span>
    </a>
    {{-- Header Navbar: style can be found in header.less --}}
    <nav class="navbar navbar-static-top">
        {{-- Sidebar toggle button --}}
        <a href="#" class="bar" data-toggle="push-menu" role="button">
            {{-- <span class="sr-only">Toggle navigation</span> --}}
            <i class="fa fa-bars"></i>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                {{-- <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset(Auth::guard('account')->user()->image) }}" class="user-image rounded-circle"
                            alt="User Image">
                    </a>
                    <ul class="dropdown-menu scale-up">
                        {{-- User image -}}
                        <li class="user-header" style="width: 200px">
                            
                          <img src="{{ asset(Auth::guard('account')->user()->image) }}" class="float-left rounded-circle" alt="User Image">
                          <div>
                              <h4>{{ Auth::guard('account')->user()->name }}</h4>
                              <p>{{ Auth::guard('account')->user()->phone }}</p>
                              <small class="mb-5">{{ Auth::guard('account')->user()->email }}</small>
                              {{-- <a href="#" class="btn btn-danger btn-sm btn-rounded">View Profile</a> -}}
                          </div>
                        
                        </li>
                        {{-- Menu Body -}}
                        
                        <li class="user-body">
                            <div class="row no-gutters">
                                <div class="col-12 text-left">
                                    <a href="#"><i class="ion ion-person"></i> My Profile</a>
                                </div>
                                <div class="col-12 text-left">
                                    <a href="#"><i class="ion ion-email-unread"></i> Inbox</a>
                                </div>
                                <div class="col-12 text-left">
                                    <a href="#"><i class="ion ion-settings"></i> Setting</a>
                                </div>
                                <div role="separator" class="divider col-12"></div>
                                <div class="col-12 text-left">
                                    <a href="#"><i class="ti-settings"></i> Account Setting</a>
                                </div>
                                <div role="separator" class="divider col-12"></div>
                                <div class="col-12 text-left">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        <i class="fa fa-power-off"></i> Sign out
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                          {{-- /.row -}}
                        </li>
                    </ul>
                </li> --}}

                {{-- User Account: style can be found in dropdown.less --}}
                <li class="dropdown user user-menu">
                    @guest('account')
                        @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('company.login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif
                @else
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{-- <img src="{{ asset(Auth::guard('account')->user()->image) }}" class="user-image rounded-circle" alt="User Image"> --}}
                        <p>{{ Auth::guard('account')->user()->name }}</p>
                    </a>
                    <ul class="dropdown-menu scale-up">
                        {{-- User image --}}
                        {{-- <li class="user-header">
                      <img src="{{ asset(Auth::guard('account')->user()->image) }}" class="float-left rounded-circle" alt="User Image">
                      <p>Admin</p>

                      <p>
                        {{ Auth::guard('account')->user()->name }}
                        <small class="mb-5">{{ Auth::guard('account')->user()->email }}</small>
                        <a href="#" class="btn btn-danger btn-sm btn-rounded">View Profile</a>
                      </p>
                    </li> --}}
                        {{-- Menu Body --}}
                        <li class="user-body" style="border-top: 0px solid #ddd;">
                            <div class="row no-gutters">

                                <div class="col-12 text-left">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                          document.getElementById('logout-form').submit();">
                                        <i class="fa fa-power-off"></i> Sign out
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                            {{-- /.row --}}
                        </li>
                    @endguest
                </ul>
                </li>
                {{-- Control Sidebar Toggle Button --}}
                {{-- <li>
                  <a href="#" data-toggle="control-sidebar"><i class="fa fa-cog fa-spin"></i></a>
                </li> --}}
            </ul>
        </div>
    </nav>
</header>
