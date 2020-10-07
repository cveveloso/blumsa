<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Catalog\CategoryContract;
use App\Repositories\Catalog\CategoryRepository;
use App\Contracts\Catalog\ProductContract;
use App\Repositories\Catalog\ProductRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        CategoryContract::class         =>          CategoryRepository::class,
        ProductContract::class         =>          ProductRepository::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface, $implementation);
        }
    }
}
