<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ProvinceService;
use App\Services\Impl\ProvinceServiceImpl;

class ProvinceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app
            ->singleton(
                ProvinceService::class,
                fn () => new ProvinceServiceImpl()
            );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
