<?php

namespace App\Http\Controllers;

use Log;
use Throwable;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Transformers\ExceptionTransformer;
use App\Http\Transformers\Users\UserTransformer;
use App\Http\Requests\Profile\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function __construct(
        protected readonly UserService $userService,
    )
    {
    }

    public function show(Request $request): JsonResponse
    {
        return $this->fractalResponse(
            request: $request,
            data: $request->user(),
            transformer: new UserTransformer,
        );
    }

    public function update(UpdateProfileRequest $request): JsonResponse
    {
        try {
            return $this->fractalResponse(
                request: $request,
                data: $this->userService->update($request->user(), $request->except('role_id')),
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
}
