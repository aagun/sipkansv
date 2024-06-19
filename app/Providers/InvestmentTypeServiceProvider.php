<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Impl\InvestmentTypeServiceImpl;
use App\Services\InvestmentTypeService;

class InvestmentTypeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(InvestmentTypeService::class, fn () => new InvestmentTypeServiceImpl());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
