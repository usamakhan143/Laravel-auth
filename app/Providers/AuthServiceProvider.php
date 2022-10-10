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
        
        //Permissions
        Gate::resource('permissions', 'App\Policies\PermissionPolicy');

        //Roles
        Gate::resource('roles', 'App\Policies\RolePolicy');
        
        // Profile
        Gate::define('profile.view', 'App\Policies\ProfilePolicy@view');
        Gate::define('profile.IdNum', 'App\Policies\ProfilePolicy@identityNumberView');

        // Shifts
        Gate::define('shift.view', 'App\Policies\ShiftPolicy@viewAll');
        Gate::define('shift.create', 'App\Policies\ShiftPolicy@create');
        Gate::define('shift.update', 'App\Policies\ShiftPolicy@update');
        Gate::define('shift.delete', 'App\Policies\ShiftPolicy@delete');

        // Main Dashboard Panel
        Gate::define('employees', 'App\Policies\DashboardpagePolicy@viewEmp');
    }
}
