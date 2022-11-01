<?php

namespace App\Providers;

use App\Models\Weapon;
use App\Policies\Policies;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Weapon::class => Policies::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate checks if the user is an admin
        Gate::define('accessAdmin', function($user) {
            return $user->role(['1']);
        });

        Gate::define('accessClientProfile', function($user) {
            return $user->role('0');
        });
    }
}
