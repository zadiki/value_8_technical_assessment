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
        'App\Models\Shop' => 'App\Policies\ShopPolicy',
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