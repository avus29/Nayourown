<?php

namespace Nayourown\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Nayourown\Model' => 'Nayourown\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes(function($router){
            $router->forAccessTokens();
        });
        
        Passport::tokensExpireIn(\now()->addDays(15));
        Passport::refreshTokensExpireIn(\now()->addDays(30));
    }
}
