<?php

namespace App\Providers;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function register(): void
    {
        //
    }

    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Store' => 'App\Policies\StorePolicy',
        'App\Models\Branch' => 'App\Policies\BranchPolicy',
        'App\Models\Inventory' => 'App\Policies\InventoryPolicy',
        'App\Models\Sale' => 'App\Policies\SalePolicy',
        'App\Models\StockMovement' => 'App\Policies\StockMovementPolicy',
        'App\Models\Order' => 'App\Policies\OrderPolicy',
        'App\Models\DeliveryNote' => 'App\Policies\DeliveryNotePolicy',

    ];

    /**
     * Bootstrap any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
        Gate::before(function ($user) {
            return $user->role === User::ROLE_ADMINISTRATOR ? true : null;
        });

        Gate::define('view-branch-audit', function (User $user) {
            return in_array($user->role, [User::ROLE_ADMINISTRATOR, User::ROLE_BRANCH_MANAGER]);
        });

        Gate::define('manage-branch', function (User $user, $branch) {
            return $user->role === User::ROLE_BRANCH_MANAGER && $user->branch_id === $branch->id;
        });
        Gate::define('manage-store', function (User $user, $store) {
            return $user->role === User::ROLE_SHOP_MANAGER && $user->store_id === $store->id;
        });
        Gate::define('make-sale', function (User $user, $store) {
            if ($user->role === User::ROLE_SHOP_MANAGER) {
                return $user->store_id === $store->id;
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
