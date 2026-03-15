<?php

namespace App\Policies;

use App\Models\Sale;
use App\Models\Store;
use App\Models\User;

class SalePolicy
{
    public function viewAny($user)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR, User::ROLE_SHOP_MANAGER, User::ROLE_BRANCH_MANAGER]);
    }

    public function makesale(User $user, Store $store): bool
    {
        // Store Managers can only make sales from their own store
        if ($user->role === User::ROLE_SHOP_MANAGER) {
            return $user->store_id === $store->id;
        }

        // Branch Managers can make sales from any store within their branch
        if ($user->role === User::ROLE_BRANCH_MANAGER) {
            return $user->branch_id === $store->branch_id;
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
