<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function register(): void
    {
        //
    }
    // needed for older laravel versions
    // protected $policies = [
    //     // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    //     'App\Models\User' => 'App\Policies\UserPolicy',
    //     'App\Models\Store' => 'App\Policies\StorePolicy',
    //     'App\Models\Branch' => 'App\Policies\BranchPolicy',
    //     'App\Models\Inventory' => 'App\Policies\InventoryPolicy',
    //     'App\Models\Sale' => 'App\Policies\SalePolicy',
    //     'App\Models\StockMovement' => 'App\Policies\StockMovementPolicy',
    //     'App\Models\Order' => 'App\Policies\OrderPolicy',
    //     'App\Models\DeliveryNote' => 'App\Policies\DeliveryNotePolicy',

    // ];

    /**
     * Bootstrap any authentication / authorization services.
     */
    public function boot(): void
    {

        Gate::before(function ($user, $ability) {
            return $user->role === User::ROLE_ADMINISTRATOR ? true : null;
        });
    }
}
