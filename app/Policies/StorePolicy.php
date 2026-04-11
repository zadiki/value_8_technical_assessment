<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

class StorePolicy
{
    public function viewAny($user)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR, User::ROLE_BRANCH_MANAGER, User::ROLE_STORE_MANAGER]);
    }

    public function view($user, $store)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR, User::ROLE_BRANCH_MANAGER, User::ROLE_STORE_MANAGER]);
    }

    public function create($user)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR, User::ROLE_BRANCH_MANAGER]);
    }

    public function update($user, $store)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR, User::ROLE_BRANCH_MANAGER]);
    }

    public function delete($user, $store)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR]);
    }
}
