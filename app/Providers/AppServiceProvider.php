<?php

namespace App\Providers;

use App\Models\backend\Profile;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('backend.layouts.sidebar', function ($view) {
            
            $pendingProfiles = Profile::where('status', 0)->get();
            $pending_Profiles = count($pendingProfiles);
            $view->with('getPendingProfiles', $pending_Profiles);

        });
    }
}
