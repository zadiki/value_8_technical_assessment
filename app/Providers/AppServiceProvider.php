<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
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

        DB::listen(function ($query) {
            Log::info(
                $query->sql,
                $query->bindings,
                $query->time
            );
        });

        Gate::before(function ($user) {
            return $user->role === User::ROLE_ADMINISTRATOR ? true : null;
        });

        Gate::define('view-branch-audit', function (User $user) {
            return in_array($user->role, [User::ROLE_ADMINISTRATOR, User::ROLE_BRANCH_MANAGER]);
        });

        Gate::define('manage-branch', function (User $user, $branch) {
            return $user->role === User::ROLE_BRANCH_MANAGER && $user->branch_id === $branch->id;
        });
        Gate::define('manage-shop', function (User $user, $shop) {
            return $user->role === User::ROLE_STORE_MANAGER && $user->shop_id === $shop->id;
        });
        Gate::define('make-sale', function (User $user, $shop) {
            if ($user->role === User::ROLE_STORE_MANAGER) {
                return $user->shop_id === $shop->id;
            }

            return false;
        });
        Gate::define('adjust-inventory', function (User $user) {
            return $user->role === User::ROLE_ADMINISTRATOR;
        });

        Gate::define('edit-user-details', function (User $user, User $targetUser) {
            // Admins can edit any user, Branch Managers can edit users in their branch, Store Managers can edit users in their store
            if ($user->role === User::ROLE_ADMINISTRATOR) {
                return true;
            }

            return false;
        });

        Gate::define('edit-user-password', function (User $user, User $targetUser) {
            // Admins can edit any user, Branch Managers can edit users in their branch, Store Managers can edit users in their store
            if ($user->role === User::ROLE_ADMINISTRATOR) {
                return true;
            }

            return false;
        });

        Gate::define('view-sales-report', function (User $user) {
            return in_array($user->role, [User::ROLE_ADMINISTRATOR, User::ROLE_BRANCH_MANAGER]);
        });
    }
}
