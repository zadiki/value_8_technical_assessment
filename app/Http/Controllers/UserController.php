<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function getAllActiveUsers(Request $request)
    {

        $this->authorize('viewAny', User::class);
        $this->validate($request, [
            'page' => 'integer|min:1',
        ]);
        $users = $this->userService->getAllActiveUsers();

        return response()->json($users);
    }

    public function getAllUsers(Request $request)
    {
        $this->authorize('view', User::class);
        $this->validate($request, [
            'page' => 'integer|min:1',
        ]);
        $users = $this->userService->getAllUsers();

        return response()->json($users);
    }

    public function disableUser(Request $request)
    {
        $this->authorize('update', User::class);
        $this->validate($request, [
            'id' => 'required|integer|exists:users,id',
        ]);
        $this->userService->disableUser($request->id);

        return response()->json([
            'status' => 'success',
            'message' => 'User disabled successfully',
        ]);
    }

    public function enableUser(Request $request)
    {
        $this->authorize('update', User::class);
        $this->validate($request, [
            'id' => 'required|integer|exists:users,id',
        ]);
        $this->userService->enableUser($request->id);

        return response()->json([
            'status' => 'success',
            'message' => 'User enabled successfully',
        ]);
    }

    public function createUser(Request $request)
    {
        $this->authorize('create', User::class);
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = $this->userService->createUser($request->only(['name', 'email', 'password']));

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'data' => $user,
        ]);
    }

    public function editUser(Request $request)
    {
        $this->authorize('update', User::class);
        $this->validate($request, [
            'id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
        ]);

        $this->userService->editUser($request->only(['name', 'email']), $request->id);

        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully',
        ]);
    }
}
