<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
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
