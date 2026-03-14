<?php

namespace App\Policies;

use App\Models\Shop;
use App\Models\StockMovement;
use App\Models\User;

class InventoryPolicy
{
    public function moveStock(User $user, Shop $fromShop, Shop $toShop, StockMovement $movement): bool
    {
        // 1. Administrators have global access across all branches
        if ($user->role === User::ROLE_ADMINISTRATOR) {
            return true;
        }

        return false;
    }

    public function adjustQuantity(User $user): bool
    {
        // Restricted to Admin to guarantee Stock Accuracy and Auditability [cite: 23, 26, 28]
        return $user->role === User::ROLE_ADMINISTRATOR;
    }

    public function adjustSellingPrice(User $user): bool
    {
        // Restricted to Admin to guarantee Pricing Accuracy and Auditability [cite: 23, 26, 28]
        return $user->role === User::ROLE_ADMINISTRATOR;
    }

    public function adjustUnitCost(User $user): bool
    {
        // Restricted to Admin to guarantee Cost Accuracy and Auditability [cite: 23, 26, 28]
        return $user->role === User::ROLE_ADMINISTRATOR;
    }

   public function adjustReorderLevel(User $user): bool
    {
        // Restricted to Admin to guarantee Reorder Level Accuracy and Auditability [cite: 23, 26, 28]
        return $user->role === User::ROLE_ADMINISTRATOR;
    }

    public function viewShopInventory(User $user, Shop $shop): bool
    {
        // 1. Administrators have global access across all branches
        if ($user->role === User::ROLE_ADMINISTRATOR) {
            return true;
        }
        if ($user->role === User::ROLE_BRANCH_MANAGER && $user->branch_id === $shop->branch_id) {
            return true;
        }

        if ($user->role === User::ROLE_SHOP_MANAGER && $user->shop_id === $shop->id) {
            return true;
        }

        return false;
    }

    public function viewBranchInventory(User $user, Branch $branch): bool
    {
        // 1. Administrators have global access across all branches
        if ($user->role === User::ROLE_ADMINISTRATOR) {
            return true;
        }
        if ($user->role === User::ROLE_BRANCH_MANAGER && $user->branch_id === $branch->id) {
            return true;
        }

        return false;
    }

    public function viewCentralWarehouseInventory(User $user): bool
    {
        // 1. Administrators have global access across all branches
        if ($user->role === User::ROLE_ADMINISTRATOR) {
            return true;
        }

        return false;
    }
}
