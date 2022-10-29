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
                <li><a href="{{ route('shifts.index') }}"><i class="fa fa-genderless"></i>Shifts</a></li>
              @endcan
                <li><a href="{{ route('mark.in') }}"><i class="fa fa-genderless"></i>Mark now</a></li>
              
              {{-- @can('', Auth::user())
                <li><a href=""><i class="fa fa-genderless"></i>Add new</a></li>
              @endcan --}}
            </ul>
          </li>
        @endcan

        {{-- @can('settings.view', Auth::user()) --}}
          <li class="treeview">
            <a href="{{-- route('setings') --}}">
              <i class="fa fa-cog"></i> <span>Settings</span>
            </a>
            <ul class="treeview-menu">
              @can('settings.view', Auth::user())
                <li><a href="{{-- route('setings') --}}"><i class="fa fa-genderless"></i>Configurations</a></li>
              @endcan
              @can('networks.view', Auth::user())
                <li><a href="{{ route('network.index') }}"><i class="fa fa-genderless"></i>Network</a></li>
              @endcan
              @can('accounts.chgPassword', Auth::user())
                <li><a href="{{ route('change.pass', Auth::user()->id) }}"><i class="fa fa-genderless"></i>Change Password</a></li>
              @endcan
            </ul>
          </li>
        {{-- @endcan --}}


        @can('accounts.view', Auth::user())
          <li class="treeview">
            <a href="{{ route('all.accounts') }}">
              <i class="fa fa-users"></i> <span>Users</span>
            </a>
            <ul class="treeview-menu">
              @can('accounts.view', Auth::user())
                <li><a href="{{ route('all.accounts') }}"><i class="fa fa-genderless"></i>All Users</a></li>
              @endcan
              @can('accounts.create', Auth::user())
                <li><a href="{{ route('accounts.create') }}"><i class="fa fa-genderless"></i>Add New User</a></li>
              @endcan
            </ul>
          </li>
        @endcan


        @can('roles.view', Auth::user())
          <li class="treeview">
            <a href="{{ route('roles.index') }}">
              <i class="fa fa-user-tag"></i> <span>Roles</span>
            </a>
            <ul class="treeview-menu">
              @can('roles.view', Auth::user())
                <li><a href="{{ route('roles.index') }}"><i class="fa fa-genderless"></i>All Roles</a></li>
              @endcan
              @can('roles.create', Auth::user())
                <li><a href="{{ route('roles.create') }}"><i class="fa fa-genderless"></i>Add New Role</a></li>
              @endcan
            </ul>
          </li>
        @endcan


        @can('permissions.view', Auth::user())
          <li class="treeview">
            <a href="{{ route('permissions.index') }}">
              <i class="fa fa-user-lock"></i> <span>Permissions</span>
            </a>
            <ul class="treeview-menu">
              @can('permissions.view', Auth::user())
                <li><a href="{{ route('permissions.index') }}"><i class="fa fa-genderless"></i>All Permissions</a></li>
              @endcan
              @can('permissions.create', Auth::user())
                <li><a href="{{ route('permissions.create') }}"><i class="fa fa-genderless"></i>Add Permission</a></li>
              @endcan
            </ul>
          </li>
        @endcan

        <li class="treeview">
            <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off"></i> <span>Sign out</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
        
      </ul>
    </section>
  </aside>