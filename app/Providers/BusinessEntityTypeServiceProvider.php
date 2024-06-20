<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\BusinessEntityTypeService;
use App\Services\Impl\BusinessEntityTypeServiceImpl;

class BusinessEntityTypeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(BusinessEntityTypeService::class, fn () => new BusinessEntityTypeServiceImpl());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
