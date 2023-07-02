<?php

namespace App\Http\Controllers\Auth;

use App\Services\AuthService;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthTokenRequest;
use App\Http\Transformers\Auth\AuthenticationTokenTransformer;

class AuthController extends Controller
{
    public function __construct(
        protected readonly AuthService $authService,
    )
    {
    }

    public function authenticate(AuthTokenRequest $request)
    {
        $user = $this->authService->getUserUsingCredentials($request->input('email'), $request->input('password'));

        return $this->fractalResponse(
            request: $request,
            data: $user->createToken($request->input('device_name')),
            transformer: new AuthenticationTokenTransformer,
            status: Response::HTTP_CREATED,
        );
    }
}
