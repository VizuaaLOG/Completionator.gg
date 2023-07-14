<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use App\Http\Requests\Users\ShowUserRequest;
use App\Http\Requests\Users\ListUsersRequest;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Requests\Users\DeleteUserRequest;

class UserController extends Controller
{
    public function __construct(
        protected readonly UserService $userService,
    )
    {
    }

    public function index(ListUsersRequest $request)
    {
        //
    }

    public function store(CreateUserRequest $request)
    {
        //
    }

    public function show(ShowUserRequest $request, User $user)
    {
        //
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    public function destroy(DeleteUserRequest $request, User $user)
    {
        //
    }
}
