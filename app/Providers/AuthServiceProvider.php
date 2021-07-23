<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\Team;
use App\Policies\TeamPolicy;
use Illuminate\Support\Facades\DB;
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
        Team::class => TeamPolicy::class,
    ];

    const SUPER_ADMIN = 1;
    const ADMIN = 2;
    const DEFAULT_USER = 3;

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Implicitly grant  "Super Admin" role all permissions
        Gate::before(function ($user){
            // dd($user->hasRole('super-admin'));
            return $user->hasRole('super-admin') ? true : null;
        });

        Gate::define('viewWebTinker', function ($user = null) {
            return true;
            return $user->hasRole('super-admin') ? true : null;
            // return true if access to web tinker is allowed
        });



    }
}
