<?php

namespace App\Services;

use App\Interfaces\UserServiceInterface;
use App\Models\User;

class UserService implements UserServiceInterface
{
    public function getAllActiveUsers()
    {
        return User::where('is_active', true)->paginate(20);
    }

    public function createUser(array $data)
    {
        // Implementation for creating a user
    }

    public function editUser(array $data, $id)
    {
        // Implementation for editing a user
        $user = User::find($id);
        if ($user) {
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->save();
        }
    }

    public function deleteUser($id)
    {
        // Implementation for deleting a user
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }
    }

    public function getAllUsers()
    {
        return User::paginate(20);
    }

    public function disableUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->is_active = false;
            $user->save();
        }
    }

    public function enableUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->is_active = true;
            $user->save();
        }
    }
}
