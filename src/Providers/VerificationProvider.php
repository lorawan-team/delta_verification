<?php

namespace Delta\DeltaVerification\Providers;

use App\Providers\AbstractServiceProvider;
use Delta\DeltaVerification\Tokens\TokenRepositoryInterface;
use Delta\DeltaVerification\Tokens\TokenRepository;
use Delta\DeltaVerification\Users\UserRepositoryInterface;
use Delta\DeltaVerification\Users\UserRepository;

class VerificationProvider extends AbstractServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig('delta_verification');
        $this->setupMigrations();
        $this->setupConnection('delta_verification', 'delta_verification.connection');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerClassAliases([
            'verification.token' => TokenRepositoryInterface::class,
            'verification.user' => UserRepositoryInterface::class,
        ]);

        $this->app->singleton('verification.token', function ($app) {
            return new TokenRepository(
                $app['events']
            );
        });

        $this->app->singleton('verification.user', function ($app) {
            return new UserRepository(
                $app['events']
            );
        });
    }
}
