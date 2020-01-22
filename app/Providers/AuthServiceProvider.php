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

        Gate::define('preform-driver-operations', function ($user) {
            return $user->isDriver();
        });

        Gate::define('preform-sponsor-operations', function ($user) {
            return $user->isSponsor();
        });

        Gate::define('preform-admin-operations', function ($user) {
            return $user->isAdmin();
        });
    }
}
