<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DomainRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \Api\Domain\User\Repository\UserRepository::class,
            \Api\Infrastructure\User\Repository\EloquentUserRepository::class
        );

        $this->app->bind(
            \Api\Domain\Car\Repository\CarRepository::class,
            \Api\Infrastructure\Car\Repository\EloquentCarRepository::class
        );

        $this->app->bind(
            \Api\Domain\CarRental\Repository\CarRentalRepository::class,
            \Api\Infrastructure\CarRental\Repository\EloquentCarRentalRepository::class
        );
    }
}
