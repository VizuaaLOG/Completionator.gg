<?php

namespace App\Http\Controllers\Games;

use App\Models\GameStatus;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\GameStatusService;
use App\Http\Controllers\Controller;
use App\Http\Transformers\Games\GameStatusTransformer;

class GameStatusController extends Controller
{
    public function __construct(
        protected readonly GameStatusService $gameStatusService,
    )
    {
    }

    public function index(Request $request): JsonResponse
    {
        return $this->fractalResponse(
            request: $request,
            data: $this->gameStatusService->all(),
            transformer: new GameStatusTransformer(),
        );
    }

    public function show(Request $request, GameStatus $gameStatus): JsonResponse
    {
        return $this->fractalResponse(
            request: $request,
            data: $gameStatus,
            transformer: new GameStatusTransformer(),
        );
    }
}
