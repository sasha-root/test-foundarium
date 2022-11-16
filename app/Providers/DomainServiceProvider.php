<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\FlareClient\Api;

class DomainServiceProvider extends ServiceProvider
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
            \Api\Domain\Car\Service\CarService::class,
            \Api\Infrastructure\Car\Service\EloquentCarService::class
        );

        $this->app->bind(
            \Api\Domain\User\Service\UserService::class,
            \Api\Infrastructure\User\Service\EloquentUserService::class
        );
    }
}
