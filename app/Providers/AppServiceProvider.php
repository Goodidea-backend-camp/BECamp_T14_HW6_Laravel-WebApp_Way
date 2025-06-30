<?php

namespace App\Providers;

use App\Repositories\Interfaces\OrderRecordRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\StoreRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\OrderRecordRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
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
        $this->app->bind(ProductRepositoryInterface::class,  ProductRepository::class);
        $this->app->bind(OrderRepositoryInterface::class,  OrderRepository::class);
        $this->app->bind(OrderRecordRepositoryInterface::class,  OrderRecordRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('components.bandon-info', 'components.bandon-info');
        Blade::component('components.login-form', 'components.login-form');
        Blade::component('components.register-form', 'components.register-form');
        Blade::component('components.bandon-form', 'components.bandon-form');
        Blade::component('components.bandon-order', 'components.bandon-order');
        Blade::component('components.bandon-orderlist', 'components.bandon-orderlist');
    }
}
