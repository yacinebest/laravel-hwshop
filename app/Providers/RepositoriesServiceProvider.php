<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(    'App\\Repositories\\Contracts\\UserRepositoryInterface' ,
                            'App\\Repositories\\UserRepository');
        
        $this->app->bind(    'App\\Repositories\\Contracts\\RoleRepositoryInterface' ,
                            'App\\Repositories\\RoleRepository');
    }
}