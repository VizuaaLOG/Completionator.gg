<?php

namespace App\Http\Controllers;

use Log;
use Throwable;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Users\ShowUserRequest;
use App\Http\Requests\Users\ListUsersRequest;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Requests\Users\DeleteUserRequest;
use App\Http\Transformers\ExceptionTransformer;
use App\Http\Transformers\Users\UserTransformer;

class UserController extends Controller
{
    public function __construct(
        protected readonly UserService $userService,
    )
    {
    }

    public function index(ListUsersRequest $request): JsonResponse
    {
        return $this->fractalResponse(
            request: $request,
            data: $this->userService->paginated($this->getPerPageCount($request)),
            transformer: new UserTransformer,
        );
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        try {
            return $this->fractalResponse(
                request: $request,
                data: $this->userService->create($request->except('role_id'), $request->input('role_id')),
                transformer: new UserTransformer,
                status: Response::HTTP_CREATED,
            );
        } catch (Throwable $e) {
            Log::error($e);
            return response()->json(status: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(ShowUserRequest $request, User $user): JsonResponse
    {
        return $this->fractalResponse(
            request: $request,
            data: $user,
            transformer: new UserTransformer,
        );
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        try {
            return $this->fractalResponse(
                request: $request,
                data: $this->userService->update($user, $request->except('role_id'), $request->input('role_id')),
                transformer: new UserTransformer,
            );
        } catch (Throwable $e) {
            Log::error($e);
            return $this->fractalResponse(
                request: $request,
                data: $e,
                transformer: new ExceptionTransformer,
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function destroy(DeleteUserRequest $request, User $user): JsonResponse
    {
        try {
            $this->userService->delete($user);
            return response()->json();
        } catch (Throwable $e) {
            Log::error($e);
            return $this->fractalResponse(
                request: $request,
                data: $e,
                transformer: new ExceptionTransformer,
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
