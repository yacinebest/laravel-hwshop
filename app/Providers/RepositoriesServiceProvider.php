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

        $this->app->bind(    'App\\Repositories\\Contracts\\CategoryRepositoryInterface' ,
                            'App\\Repositories\\CategoryRepository');

        $this->app->bind(    'App\\Repositories\\Contracts\\ImageRepositoryInterface' ,
                            'App\\Repositories\\ImageRepository');

        $this->app->bind(    'App\\Repositories\\Contracts\\BrandRepositoryInterface' ,
                            'App\\Repositories\\BrandRepository');

        $this->app->bind(    'App\\Repositories\\Contracts\\ProductRepositoryInterface' ,
                            'App\\Repositories\\ProductRepository');

        $this->app->bind(    'App\\Repositories\\Contracts\\OrderRepositoryInterface' ,
                            'App\\Repositories\\OrderRepository');

        $this->app->bind(    'App\\Repositories\\Contracts\\CommentRepositoryInterface' ,
                            'App\\Repositories\\CommentRepository');

        $this->app->bind(    'App\\Repositories\\Contracts\\SupplyRepositoryInterface' ,
                            'App\\Repositories\\SupplyRepository');

        $this->app->bind(    'App\\Repositories\\Contracts\\HistoryRepositoryInterface' ,
                            'App\\Repositories\\HistoryRepository');


    }
}
