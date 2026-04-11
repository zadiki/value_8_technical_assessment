<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Interfaces\UserServiceInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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

        $validated = $request->validate(['page' => 'integer|min:1']);
        Gate::authorize('viewAny', User::class);

        $users = $this->userService->getAllActiveUsers();

        return response()->json($users);
    }

    public function getAllUsers(Request $request)
    {

        Gate::authorize('viewAny', User::class);

        $validated = $request->validate(['page' => 'integer|min:1']);
        $users = $this->userService->getAllUsers();

        return response()->json($users);
    }

    public function disableUser(Request $request)
    {

        Gate::authorize('update', User::class);

        $validated = $request->validate(['id' => 'required|integer|exists:users,id']);
        $this->userService->disableUser($request->id);

        return response()->json([
            'status' => 'success',
            'message' => 'User disabled successfully',
        ]);
    }

    public function enableUser(Request $request)
    {

        Gate::authorize('update', User::class);

        $validated = $request->validate(['id' => 'required|integer|exists:users,id']);
        $this->userService->enableUser($request->id);

        return response()->json([
            'status' => 'success',
            'message' => 'User enabled successfully',
        ]);
    }

    public function createUser(Request $request)
    {

        Gate::authorize('create', User::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'store_id' => 'nullable|integer|exists:stores,id',
            'branch_id' => 'nullable|integer|exists:branches,id',
            'role' => 'required|string|in:'.User::ROLE_ADMINISTRATOR.','.User::ROLE_STORE_MANAGER.','.User::ROLE_BRANCH_MANAGER,
        ]);

        $user = $this->userService->createUser($request->only(['name', 'email', 'password', 'store_id', 'branch_id', 'role']));
        UserRegistered::dispatch($user);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'data' => $user,
        ]);
    }

    public function editUser(Request $request)
    {
        Gate::authorize('update', User::class);
        $validated = $request->validate([
            'id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
        ]);

        $this->userService->editUser($request->only(['name', 'email', 'store_id', 'branch_id', 'role']), $request->id);

        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully',
        ]);
    }
}
