<?php

declare(strict_types=1);

namespace App\Interfaces;

interface UserServiceInterface
{
    public function getAllActiveUsers();

    public function createUser(array $data);

    public function editUser(array $data, $id);

    public function deleteUser($id);

    public function getAllUsers();

    public function disableUser($id);

    public function enableUser($id);
}
