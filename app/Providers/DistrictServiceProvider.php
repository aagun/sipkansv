<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DistrictService;
use App\Services\Impl\DistrictServiceImpl;

class DistrictServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app
            ->singleton(
                DistrictService::class,
                fn () => new DistrictServiceImpl()
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
