<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Tymon\JWTAuth\Contracts\Providers\JWT as JWTContract;
use Tymon\JWTAuth\Providers\JWT\Lcobucci;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }

    public function register()
{
    $this->app->bind(JWTContract::class, function ($app) {
        return new Lcobucci(
            $app['config']['jwt.secret'],
            $app['config']['jwt.algo'],
            $app['config']['jwt.keys'],
            $app['config']['jwt.required_claims']
        );
    });
}
}

