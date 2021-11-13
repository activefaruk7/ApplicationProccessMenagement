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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is-teacher', function ($user) {
            if ($user->isTeacher()) {
                return true;
            }
        });
        Gate::define('is-management', function ($user) {
            if ($user->isDin() || $user->isHead() || $user->isOther3() || $user->isOther4() || $user->isOther5()) {
                return true;
            }
        });
    }
}
