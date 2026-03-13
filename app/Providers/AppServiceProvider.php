<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind('App\Interfaces\ShopServiceInterface', 'App\Services\ShopService');
        $this->app->bind('App\Interfaces\InventoryServiceInterface', 'App\Services\InventoryService');
        $this->app->bind('App\Interfaces\OrderServiceInterface', 'App\Services\OrderService');
        $this->app->bind('App\Interfaces\DeliveryNoteServiceInterface', 'App\Services\DeliveryNoteService');
        $this->app->bind('App\Interfaces\SaleServiceInterface', 'App\Services\SaleService');
        $this->app->bind('App\Interfaces\BranchServiceInterface', 'App\Services\BranchService');
        $this->app->bind('App\Interfaces\ProductServiceInterface', 'App\Services\ProductService');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
