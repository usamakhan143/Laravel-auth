<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="">
                <a href="{{ route('dashboard.home') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            @can('AttendanceRoot.link', Auth::user())
                <li class="treeview">
                    <a href="{{-- route('') --}}">
                        <i class="fa fa-calendar"></i>
                        <span>Attendance</span>
                    </a>
                    <ul class="treeview-menu">
                        @can('shift.view', Auth::user())
                            <li><a href="{{ route('shifts.index') }}" class="ribbon-wrapper-reverse bg-info"><i class="fa fa-genderless"></i>Shifts</a></li>
                        @endcan
                        @can('Attendance.mark', Auth::user())
                            <li><a href="{{ route('mark.in') }}" class="ribbon-wrapper-reverse bg-info"><i class="fa fa-genderless"></i>Mark now</a></li>
                        @endcan
                        @can('Holiday.view', Auth::user())
                            <li><a href="{{ route('all.holidays') }}" class="ribbon-wrapper-reverse bg-info"><i class="fa fa-genderless"></i>Holidays</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('reports.link', Auth::user())
                <li class="treeview">
                    <a href="{{-- route('') --}}">
                        <i class="fa fa-file-text-o"></i>
                        <span>Report</span>
                    </a>
                    <ul class="treeview-menu">
                        @can('reports.generate', Auth::user())
                            <li><a href="{{ route('report.create') }}" class="ribbon-wrapper-reverse bg-info"><i class="fa fa-genderless"></i>Generate Report</a></li>
                        @endcan
                        @can('reports.thismonth', Auth::user())
                            <li><a href="{{ route('report.allatt') }}" class="ribbon-wrapper-reverse bg-info"><i class="fa fa-genderless"></i>All {{ date('M') }}
                                    Attendance</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('settings.view', Auth::user())
                <li class="treeview">
                    <a href="{{-- route('setings') --}}">
                        <i class="fa fa-cog"></i> <span>Settings</span>
                    </a>
                    <ul class="treeview-menu">
                        @can('networks.view', Auth::user())
                            <li><a href="{{ route('network.index') }}" class="ribbon-wrapper-reverse bg-info"><i class="fa fa-genderless"></i>Network</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan


            @can('accounts.view', Auth::user())
                <li class="treeview">
                    <a href="{{ route('all.accounts') }}">
                        <i class="fa fa-user-o"></i> <span>Employees</span>
                    </a>
                    <ul class="treeview-menu">
                        @can('accounts.view', Auth::user())
                            <li><a href="{{ route('all.accounts') }}" class="ribbon-wrapper-reverse bg-info"><i class="fa fa-genderless"></i>All Employees</a></li>
                        @endcan
                        @can('accounts.create', Auth::user())
                            <li><a href="{{ route('accounts.create') }}" class="ribbon-wrapper-reverse bg-info"><i class="fa fa-genderless"></i>Add New Employee</a></li>
                        @endcan
                        @can('pending.profiles', Auth::user())
                            <li><a href="{{ route('pend.profile') }}" class="ribbon-wrapper-reverse bg-info"><i class="fa fa-genderless"></i>Pending Profiles @if($getPendingProfiles != 0)<div class="ribbon ribbon-vertical-r bg-danger">+{{$getPendingProfiles}}</div>@endif</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan


            @can('roles.view', Auth::user())
                <li class="treeview">
                    <a href="{{ route('roles.index') }}">
                        <i class="mdi mdi-tag-text-outline"></i> <span>Roles</span>
                    </a>
                    <ul class="treeview-menu">
                        @can('roles.view', Auth::user())
                            <li><a href="{{ route('roles.index') }}" class="ribbon-wrapper-reverse bg-info"><i class="fa fa-genderless"></i>All Roles</a></li>
                        @endcan
                        @can('roles.create', Auth::user())
                            <li><a href="{{ route('roles.create') }}" class="ribbon-wrapper-reverse bg-info"><i class="fa fa-genderless"></i>Add New Role</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan


            @can('permissions.view', Auth::user())
                <li class="treeview">
                    <a href="{{ route('permissions.index') }}">
                        <i class="mdi mdi-lock-open-outline"></i> <span>Permissions</span>
                    </a>
                    <ul class="treeview-menu">
                        @can('permissions.view', Auth::user())
                            <li><a href="{{ route('permissions.index') }}" class="ribbon-wrapper-reverse bg-info"><i class="fa fa-genderless"></i>All Permissions</a>
                            </li>
                        @endcan
                        @can('permissions.create', Auth::user())
                            <li><a href="{{ route('permissions.create') }}" class="ribbon-wrapper-reverse bg-info"><i class="fa fa-genderless"></i>Add Permission</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            {{-- <li class="treeview">
            <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off"></i> <span>Sign out</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li> --}}

        </ul>
    </section>
</aside>
