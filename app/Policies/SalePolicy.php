<?php

namespace App\Policies;

use App\Models\Sale;
use App\Models\Shop;
use App\Models\User;

class SalePolicy
{
    public function viewAny($user)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR, User::ROLE_SHOP_MANAGER, User::ROLE_BRANCH_MANAGER]);
    }

    public function makesale(User $user, Shop $shop): bool
    {
        // Shop Managers can only make sales from their own shop
        if ($user->role === User::ROLE_SHOP_MANAGER) {
            return $user->shop_id === $shop->id;
        }

        // Branch Managers can make sales from any shop within their branch
        if ($user->role === User::ROLE_BRANCH_MANAGER) {
            return $user->branch_id === $shop->branch_id;
        }

        // Administrators have global access
        return $user->role === User::ROLE_ADMINISTRATOR;
    }

    public function deleteSale(User $user, Sale $sale): bool
    {
        // Only Administrators can delete sales to maintain data integrity and audit trails [cite: 23, 26, 28]
        return $user->role === User::ROLE_ADMINISTRATOR;
    }

    public function editSale(User $user, Sale $sale): bool
    {
        // Only Administrators can edit sales to maintain data integrity and audit trails [cite: 23, 26, 28]
        return $user->role === User::ROLE_ADMINISTRATOR;
    }
}
