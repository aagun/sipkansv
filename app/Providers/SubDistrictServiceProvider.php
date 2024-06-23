<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SubDistrictService;
use App\Services\Impl\SubDistrictServiceImpl;

class SubDistrictServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app
            ->singleton(
                SubDistrictService::class,
                fn () => new SubDistrictServiceImpl()
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
