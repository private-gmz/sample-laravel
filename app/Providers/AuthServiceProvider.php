<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Auth;

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
        $allroles = \App\Helpers\Helpers::get_roles();
        foreach ($allroles as $one_role){
            Gate::define($one_role->name, function () use ($one_role) {
                return Auth::user()->role_id == $one_role->id || Auth::user()->role_id == 1;
            });
        }
    }
}
