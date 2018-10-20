<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    // protected $policies = [
    //     'App\Model' => 'App\Policies\ModelPolicy',
    // ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('crud-district', 'App\Policies\DistrictPolicy@crudDistrict');
        Gate::define('crud-facility', 'App\Policies\FacilityPolicy@crudFacility');
        Gate::define('crud-ipcLeader', 'App\Policies\IpcLeaderPolicy@crudIpcLeader');
        Gate::define('crud-region', 'App\Policies\RegionPolicy@crudRegion');
        Gate::define('crud-staff', 'App\Policies\StaffPolicy@crudStaff');

    }
}
