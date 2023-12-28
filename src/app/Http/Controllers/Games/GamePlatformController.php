<?php

namespace App\Http\Controllers\Games;

use Log;
use Throwable;
use App\Models\Game;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\GameService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Transformers\ExceptionTransformer;
use App\Http\Transformers\Games\GameTransformer;
use App\Http\Requests\Games\AttachPlatformsRequest;
use App\Http\Transformers\Platforms\PlatformTransformer;

class GamePlatformController extends Controller
{
    public function __construct(
        protected readonly GameService $gameService,
    )
    {
    }

    public function index(Request $request, Game $game): JsonResponse
    {
        return $this->fractalResponse(
            request: $request,
            data: $game->platforms()->paginate($this->getPerPageCount($request)),
            transformer: new PlatformTransformer,
        );
    }

    public function store(AttachPlatformsRequest $request, Game $game): JsonResponse
    {
        try {
            $this->gameService->attachToPlatforms($game, $request->get('platform_ids', []));
            return response()->json(status: Response::HTTP_CREATED);
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

    public function destroy(Request $request, Game $game, Platform $platform): JsonResponse
    {
        try {
            $this->gameService->detachFromPlatforms($game, [$platform->id]);
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
