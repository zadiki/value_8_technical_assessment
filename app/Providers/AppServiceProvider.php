<?php

namespace App\Providers;

use App\Interfaces\BranchServiceInterface;
use App\Interfaces\DeliveryNoteServiceInterface;
use App\Interfaces\InventoryServiceInterface;
use App\Interfaces\OrderServiceInterface;
use App\Interfaces\ProductServiceInterface;
use App\Interfaces\SaleServiceInterface;
use App\Interfaces\StoreServiceInterface;
use App\Services\BranchService;
use App\Services\DeliveryNoteService;
use App\Services\InventoryService;
use App\Services\OrderService;
use App\Services\ProductService;
use App\Services\SaleService;
use App\Services\StoreService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(StoreServiceInterface::class, StoreService::class);
        $this->app->singleton(InventoryServiceInterface::class, InventoryService::class);
        $this->app->singleton(OrderServiceInterface::class, OrderService::class);
        $this->app->singleton(DeliveryNoteServiceInterface::class, DeliveryNoteService::class);
        $this->app->singleton(SaleServiceInterface::class, SaleService::class);
        $this->app->singleton(BranchServiceInterface::class, BranchService::class);
        $this->app->singleton(ProductServiceInterface::class, ProductService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Only log queries in the local environment
        if (config('app.env') === 'local') {
            DB::listen(function ($query) {
                Log::info('SQL Query executed:', [
                    'sql' => $query->sql,
                    'bindings' => $query->bindings,
                    'time' => $query->time.'ms',
                ]);
            });
        }
    }
}
