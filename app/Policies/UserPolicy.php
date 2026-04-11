<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny($user)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR, User::ROLE_STORE_MANAGER]);
    }

    public function view($user, $model)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR]);
    }

    public function create($user)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR]);
    }

    public function update($user, $model)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR]);
    }

    public function delete($user, $model)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR]);
    }

    public function disableUser($user, $model)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR]);
    }
}
