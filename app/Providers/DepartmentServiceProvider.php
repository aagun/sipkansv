<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DepartmentService;
use App\Services\Impl\DepartmentServiceImpl;

class DepartmentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(DepartmentService::class, fn () => new DepartmentServiceImpl());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
