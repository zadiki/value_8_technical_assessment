<?php

namespace App\Policies;

class StockMovementPolicy
{
    public function viewAny($user)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR, User::ROLE_STORE_MANAGER, User::ROLE_BRANCH_MANAGER]);
    }

    public function viewAllStockmovements(User $user): bool
    {
        if ($user->role === User::ROLE_ADMINISTRATOR || $user->role === User::ROLE_BRANCH_MANAGER) {
            return true;
        }

        return false; // No direct access to stock movements
    }

    public function viewStoreStockmovements(User $user, Store $store): bool
    {
        if ($user->role === User::ROLE_STORE_MANAGER) {
            return $user->store_id === $store->id; // Store Managers can view stock movements related to their store
        }
        if ($user->role === User::ROLE_BRANCH_MANAGER) {
            return $user->branch_id === $store->branch_id; // Branch Managers can view stock movements for any store in their branch
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
