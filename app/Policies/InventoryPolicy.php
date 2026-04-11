<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Branch;
use App\Models\StockMovement;
use App\Models\Store;
use App\Models\User;

class InventoryPolicy
{
    public function viewAny($user)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR, User::ROLE_STORE_MANAGER, User::ROLE_BRANCH_MANAGER]);
    }

    public function viewMasterInventory($user)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR]);
    }

    public function moveStock(User $user, Store $fromStore, Store $toStore, StockMovement $movement): bool
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

    public function viewStoreInventory(User $user, $store): bool
    {
        return true;
        // 1. Administrators have global access across all branches
        if ($user->role === User::ROLE_ADMINISTRATOR) {
            return true;
        }
        if ($user->role === User::ROLE_BRANCH_MANAGER && $user->branch_id === $store->branch_id) {
            return true;
        }

        if ($user->role === User::ROLE_STORE_MANAGER && $user->store_id === $store->id) {
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
