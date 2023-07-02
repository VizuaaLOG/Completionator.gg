<?php

namespace App\Http\Controllers\Games;

use Log;
use Throwable;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\GameService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Games\CreateGameRequest;
use App\Http\Requests\Games\UpdateGameRequest;
use App\Http\Transformers\ExceptionTransformer;
use App\Http\Transformers\Games\GameTransformer;

class GameController extends Controller
{
    public function __construct(
        protected readonly GameService $gameService,
    )
    {
    }

    public function index(Request $request): JsonResponse
    {
        return $this->fractalResponse(
            request: $request,
            data: $this->gameService->paginated($this->getPerPageCount($request)),
            transformer: new GameTransformer,
        );
    }

    public function store(CreateGameRequest $request): JsonResponse
    {
        try {
            return $this->fractalResponse(
                request: $request,
                data: $this->gameService->create($request->all()),
                transformer: new GameTransformer,
                status: Response::HTTP_CREATED,
            );
        } catch(Throwable $e) {
            Log::error($e);
            return $this->fractalResponse(
                request: $request,
                data: $e,
                transformer: new ExceptionTransformer,
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function show(Request $request, Game $game): JsonResponse
    {
        return $this->fractalResponse(
            request: $request,
            data: $game,
            transformer: new GameTransformer(),
        );
    }

    public function update(UpdateGameRequest $request, Game $game): JsonResponse
    {
        try {
            return $this->fractalResponse(
                request: $request,
                data: $this->gameService->update($game, $request->all()),
                transformer: new GameTransformer(),
                status: Response::HTTP_OK,
            );
        } catch(Throwable $e) {
            Log::error($e);
            return $this->fractalResponse(
                request: $request,
                data: $e,
                transformer: new ExceptionTransformer,
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function destroy(Request $request, Game $game): JsonResponse
    {
        try {
            $this->gameService->delete($game);
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
