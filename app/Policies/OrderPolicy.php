<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function viewAny($user)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR, User::ROLE_STORE_MANAGER, User::ROLE_BRANCH_MANAGER]);
    }

    public function view(User $user, Order $order): bool
    {
        // Store Managers can only view orders from their own store
        if ($user->role === User::ROLE_STORE_MANAGER) {
            return $user->store_id === $order->store_id;
        }

        // Branch Managers can view orders from any store within their branch
        if ($user->role === User::ROLE_BRANCH_MANAGER) {
            return $user->branch_id === $order->store->branch_id;
        }

        // Administrators have global access
        return $user->role === User::ROLE_ADMINISTRATOR;
    }

    public function approveOrder(User $user, Order $order): bool
    {
        // Only Administrators can approve orders to maintain control over inventory changes [cite: 23, 26, 28]
        return $user->role === User::ROLE_ADMINISTRATOR;
    }

    public function deleteOrder(User $user, Order $order): bool
    {
        // Only Administrators can delete orders to maintain data integrity and audit trails [cite: 23, 26, 28]
        return $user->role === User::ROLE_ADMINISTRATOR;
    }

    public function editOrder(User $user, Order $order): bool
    {
        // Only Administrators can edit orders to maintain data integrity and audit trails [cite: 23, 26, 28]
        return $user->role === User::ROLE_ADMINISTRATOR;
    }

    public function dismissOrder(User $user, Order $order): bool
    {
        // Only Administrators can dismiss orders to maintain data integrity and audit trails [cite: 23, 26, 28]
        return $user->role === User::ROLE_ADMINISTRATOR;
    }
}
