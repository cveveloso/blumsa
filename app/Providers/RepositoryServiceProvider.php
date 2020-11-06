<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Catalog\CategoryContract;
use App\Repositories\Catalog\CategoryRepository;
use App\Contracts\Catalog\ProductContract;
use App\Repositories\Catalog\ProductRepository;
use App\Contracts\Catalog\AttributeGroupContract;
use App\Repositories\Catalog\AttributeGroupRepository;
use App\Contracts\Catalog\AttributeContract;
use App\Repositories\Catalog\AttributeRepository;
use App\Contracts\UserContract;
use App\Repositories\UserRepository;
use App\Contracts\CustomerContract;
use App\Repositories\CustomerRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        CategoryContract::class        =>          CategoryRepository::class,
        AttributeGroupContract::class  =>          AttributeGroupRepository::class,
        AttributeContract::class       =>          AttributeRepository::class,
        ProductContract::class         =>          ProductRepository::class,
        UserContract::class            =>          UserRepository::class,
        CustomerContract::class        =>          CustomerRepository::class,
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
