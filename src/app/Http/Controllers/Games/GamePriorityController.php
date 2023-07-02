<?php

namespace App\Http\Controllers\Games;

use Illuminate\Http\Request;
use App\Models\GamePriority;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\GamePriorityService;
use App\Http\Transformers\Games\GamePriorityTransformer;

class GamePriorityController extends Controller
{
    public function __construct(
        protected readonly GamePriorityService $gamePriorityService,
    )
    {
    }

    public function index(Request $request): JsonResponse
    {
        return $this->fractalResponse(
            request: $request,
            data: $this->gamePriorityService->all(),
            transformer: new GamePriorityTransformer(),
        );
    }

    public function show(Request $request, GamePriority $gamePriority): JsonResponse
    {
        return $this->fractalResponse(
            request: $request,
            data: $gamePriority,
            transformer: new GamePriorityTransformer(),
        );
    }
}
