<?php

namespace App\Http\Controllers\Actions\Auth;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class DeleteCurrentSession extends Controller
{
    public function __construct(
        protected readonly AuthService $authService,
    )
    {
    }

    public function __invoke(Request $request)
    {
        if (!$this->authService->logout($request->user())) {
            return response()->json(status: Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json();
    }
}
