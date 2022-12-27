<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Accounts
        Gate::resource('accounts', 'App\Policies\AccountPolicy');
        
        // Change password
        Gate::define('accounts.chgPassword', 'App\Policies\AccountPolicy@chgPassword');
        
        // Permissions
        Gate::resource('permissions', 'App\Policies\PermissionPolicy');

        // Roles
        Gate::resource('roles', 'App\Policies\RolePolicy');
        
        // Profile
        Gate::define('profile.view', 'App\Policies\ProfilePolicy@view');
        Gate::define('profile.IdNum', 'App\Policies\ProfilePolicy@identityNumberView');
        Gate::define('profile.Idcard', 'App\Policies\ProfilePolicy@idCard');
        Gate::define('profile.activate', 'App\Policies\ProfilePolicy@activateProfile');

        // Shifts
        Gate::define('shift.view', 'App\Policies\ShiftPolicy@viewAll');
        Gate::define('shift.create', 'App\Policies\ShiftPolicy@create');
        Gate::define('shift.update', 'App\Policies\ShiftPolicy@update');
        Gate::define('shift.delete', 'App\Policies\ShiftPolicy@delete');

        // Attendance
        Gate::define('AttendanceRoot.link', 'App\Policies\AttendancePolicy@attendanceLink');
        Gate::define('Attendance.mark', 'App\Policies\AttendancePolicy@attendanceMark');

        // Main Dashboard Panel
        Gate::define('employees', 'App\Policies\DashboardpagePolicy@viewEmp');
        Gate::define('employees.insideoffice', 'App\Policies\DashboardpagePolicy@viewAttendance');
        Gate::define('pending.profiles', 'App\Policies\DashboardpagePolicy@viewPendingProf');

        // Network
        Gate::define('networks.view', 'App\Policies\NetworkPolicy@viewAll');
        Gate::define('networks.create', 'App\Policies\NetworkPolicy@create');
        Gate::define('networks.update', 'App\Policies\NetworkPolicy@update');
        Gate::define('networks.delete', 'App\Policies\NetworkPolicy@delete');

        // Report
        Gate::define('reports.link', 'App\Policies\ReportPolicy@reportLink');
        Gate::define('reports.generate', 'App\Policies\ReportPolicy@generate');
        Gate::define('reports.thismonth', 'App\Policies\ReportPolicy@allThisMonthAttendance');
        Gate::define('reports.singlepageuserattend', 'App\Policies\ReportPolicy@userSinglePageAttendance');

        // Other
        Gate::define('settings.view', 'App\Policies\SettingPolicy@settingLink');

        // Holiday
        Gate::define('Holiday.view', 'App\Policies\HolidayPolicy@holidayIndex');
        Gate::define('Holiday.create', 'App\Policies\HolidayPolicy@holidayCreate');
        Gate::define('Holiday.edit', 'App\Policies\HolidayPolicy@holidayEdit');
        Gate::define('Holiday.delete', 'App\Policies\HolidayPolicy@holidayDelete');
    }
}
