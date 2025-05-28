<?php

namespace App\Providers;

use App\Repositories\Interfaces\StoreRepositoryInterface;
use App\Repositories\StoreRepository;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StoreRepositoryInterface::class, StoreRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('components.bandon-info', 'components.bandon-info');
        Blade::component('components.login-form', 'components.login-form');
        Blade::component('components.register-form', 'components.register-form');
    }
}
