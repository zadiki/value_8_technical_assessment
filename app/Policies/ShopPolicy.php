<?php

namespace App\Policies;

use App\Models\User;

class ShopPolicy
{
    public function viewAny($user)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR, User::ROLE_BRANCH_MANAGER, User::ROLE_SHOP_MANAGER]);
    }

    public function view($user, $shop)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR, User::ROLE_BRANCH_MANAGER, User::ROLE_SHOP_MANAGER]);
    }

    public function create($user)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR, User::ROLE_BRANCH_MANAGER]);
    }

    public function update($user, $shop)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR, User::ROLE_BRANCH_MANAGER]);
    }

    public function delete($user, $shop)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR]);
    }
}
