<?php

namespace App\Policies;

use App\Models\Shop;
use App\Models\User;
use App\Models\Store;
use App\Models\StockMovement;

class InventoryPolicy
{
    /**
     * Authorize stock movements (Transfers/Sales)
     * Models: Administrator, Branch Manager, Store Manager 
     */
    public function moveStock(User $user, Shop $fromShop, Shop $toShop, StockMovement $movement): bool
    {
        // 1. Administrators have global access across all branches 
        if ($user->role === User::ROLE_ADMINISTRATOR) {
            return true;
        }

        // 2. Branch Managers: Can move stock within their specific branch 
        // Covers: Intra-branch transfers 
        if ($user->role === User::ROLE_BRANCH_MANAGER) {
            $isWithinBranch = $toShop && ($fromShop->branch_id === $toShop->branch_id);
            return $user->branch_id === $fromShop->branch_id && $isWithinBranch;
        }

        // 3. Store Managers: Can only perform sales or initiate transfers from their own store [cite: 17, 23]
        if ($user->role === User::ROLE_STORE_MANAGER) {
            return $user->shop_id === $fromShop->id;
        }

        return false;
    }

    /**
     * Determine if user can perform stock adjustments 
     */
    public function adjust(User $user): bool
    {
        // Restricted to Admin to guarantee Stock Accuracy and Auditability [cite: 23, 26, 28]
        return $user->role === User::ROLE_ADMINISTRATOR;
    }

    public function makesale(User $user, Shop $shop): bool
    {
        // Store Managers can only make sales from their own store 
        if ($user->role === User::ROLE_STORE_MANAGER) {
            return $user->shop_id === $shop->id;
        }

        // Branch Managers can make sales from any store within their branch 
        if ($user->role === User::ROLE_BRANCH_MANAGER) {
            return $user->branch_id === $shop->branch_id;
        }

        // Administrators have global access 
        return $user->role === User::ROLE_ADMINISTRATOR;
    }
}
