<?php

namespace App\Policies;

class UserPolicy
{
    public function viewAny($user)
    {
        return in_array($user->role, [User::ROLE_ADMINISTRATOR]);
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
}
