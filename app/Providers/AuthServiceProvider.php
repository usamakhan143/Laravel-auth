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
        // Gate::define('accounts.chgPassword', 'App\Policies\AccountPolicy@chgPassword');
        
        //Permissions
        Gate::resource('permissions', 'App\Policies\PermissionPolicy');

        //Roles
        Gate::resource('roles', 'App\Policies\RolePolicy');
    }
}
