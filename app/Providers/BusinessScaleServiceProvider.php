<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\BusinessScaleService;
use App\Services\Impl\BusinessScaleServiceImpl;

class BusinessScaleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app
            ->singleton(
                BusinessScaleService::class,
                fn () => new BusinessScaleServiceImpl()
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
