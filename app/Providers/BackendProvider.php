<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BackendProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repository\contracts\BaseRepositoryInterface',
            'App\Repository\sql\BaseRepository'
        );
        $this->app->bind(
            'App\Repository\contracts\AdminRepositoryInterface',
            'App\Repository\sql\AdminRepository'
        );
        $this->app->bind(
            'App\Repository\contracts\CityRepositoryInterface',
            'App\Repository\sql\CityRepository'
        );
        $this->app->bind(
            'App\Repository\contracts\ColorRepositoryInterface',
            'App\Repository\sql\ColorRepository'
        );
        $this->app->bind(
            'App\Repository\contracts\CountryRepositoryInterface',
            'App\Repository\sql\CountryRepository'
        );
        $this->app->bind(
            'App\Repository\contracts\DepartmentRepositoryInterface',
            'App\Repository\sql\DepartmentRepository'
        );
        $this->app->bind(
            'App\Repository\contracts\ProductRepositoryInterface',
            'App\Repository\sql\ProductRepository'
        );
        $this->app->bind(
            'App\Repository\contracts\StateRepositoryInterface',
            'App\Repository\sql\StateRepository'
        );
        $this->app->bind(
            'App\Repository\contracts\TrademarkRepositoryInterface',
            'App\Repository\sql\TrademarkRepository'
        );
        $this->app->bind(
            'App\Repository\contracts\UserRepositoryInterface',
            'App\Repository\sql\UserRepository'
        );

        $this->app->bind(
            'App\Repository\contracts\User\UserRepositoryInterface',
            'App\Repository\sql\User\UserRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
