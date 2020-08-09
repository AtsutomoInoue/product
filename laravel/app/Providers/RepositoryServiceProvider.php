<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            \App\Repositories\CyclingsRepositoryInterface::class,
            \App\Repositories\CyclingsEloquentRepository::class,
            \App\repositories\PlamodelsRepositoryInterface::class,
            \App\repositories\PlamodelsEloquentRepository::class
        );
    }

    public function boot()
    {
        //
    }
}
