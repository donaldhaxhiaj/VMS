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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::resource('visitors', 'App\Policies\VisitorPolicy');
        Gate::resource('users', 'App\Policies\UserPolicy');
        Gate::resource('visits', 'App\Policies\VisitPolicy');
        Gate::define('posts.tag', 'App\Policies\PostPolicy@tag');
        Gate::define('posts.category', 'App\Policies\PostPolicy@category');
        Gate::define('users.role', 'App\Policies\UserPolicy@role');
        Gate::define('users.permission', 'App\Policies\UserPolicy@permission');
        Gate::define('users.company', 'App\Policies\UserPolicy@company');
        Gate::define('visits.visit', 'App\Policies\VisitPolicy@visit');

    }
}
