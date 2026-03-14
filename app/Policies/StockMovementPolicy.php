<?php

namespace App\Policies;

class StockMovementPolicy
{
    public function viewAllStockmovements(User $user): bool
    {
        if ($user->role === User::ROLE_ADMINISTRATOR || $user->role === User::ROLE_BRANCH_MANAGER) {
            return true;
        }

        return false; // No direct access to stock movements
    }

    public function viewShopStockmovements(User $user, Shop $shop): bool
    {
        if ($user->role === User::ROLE_SHOP_MANAGER) {
            return $user->shop_id === $shop->id; // Shop Managers can view stock movements related to their shop
        }
        if ($user->role === User::ROLE_BRANCH_MANAGER) {
            return $user->branch_id === $shop->branch_id; // Branch Managers can view stock movements for any shop in their branch
        }
        if ($user->role === User::ROLE_ADMINISTRATOR) {
            return true; // Administrators have global access
        }

        return false; // No direct access to stock movements
    }

    public function viewBranchStockmovements(User $user, Branch $branch): bool
    {
        if ($user->role === User::ROLE_BRANCH_MANAGER) {
            return $user->branch_id === $branch->id; // Branch Managers can view stock movements for any store in their branch
        }
        if ($user->role === User::ROLE_ADMINISTRATOR) {
            return true; // Administrators have global access
        }

        return false; // No direct access to stock movements
    }
}
