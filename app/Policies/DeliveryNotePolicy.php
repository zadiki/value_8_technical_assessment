<?php

namespace App\Policies;

use App\Models\DeliveryNote;
use App\Models\User;

class DeliveryNotePolicy
{
    public function viewAny($user)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR, User::ROLE_SHOP_MANAGER, User::ROLE_BRANCH_MANAGER]);
    }

    public function view(User $user, DeliveryNote $deliveryNote): bool
    {
        // Shop Managers can only view delivery notes from their own shop
        if ($user->role === User::ROLE_SHOP_MANAGER) {
            return $user->shop_id === $deliveryNote->shop_id;
        }

        // Branch Managers can view delivery notes from any shop within their branch
        if ($user->role === User::ROLE_BRANCH_MANAGER) {
            return $user->branch_id === $deliveryNote->shop->branch_id;
        }

        // Administrators have global access
        return $user->role === User::ROLE_ADMINISTRATOR;
    }

    public function approveDeliveryNote(User $user, DeliveryNote $deliveryNote): bool
    {
        // Only Administrators can approve delivery notes to maintain control over inventory changes [cite: 23, 26, 28]
        return $user->role === User::ROLE_ADMINISTRATOR;
    }

    public function deleteDeliveryNote(User $user, DeliveryNote $deliveryNote): bool
    {
        // Only Administrators can delete delivery notes to maintain data integrity and audit trails [cite: 23, 26, 28]
        return $user->role === User::ROLE_ADMINISTRATOR;
    }

    public function editDeliveryNote(User $user, DeliveryNote $deliveryNote): bool
    {
        // Only Administrators can edit delivery notes to maintain data integrity and audit trails [cite: 23, 26, 28]
        return $user->role === User::ROLE_ADMINISTRATOR;
    }
}
