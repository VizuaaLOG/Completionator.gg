<?php

namespace App\Http\Controllers\Games;

use Log;
use Throwable;
use App\Models\Game;
use Illuminate\Http\Request;
use App\Services\GameService;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Games\CreateGameRequest;
use App\Http\Requests\Games\UpdateGameRequest;

class GameController extends Controller
{
    public function __construct(
        protected readonly GameService $gameService,
    )
    {
    }

    public function index(Request $request): View
    {
        $games = $this->gameService->paginated();
        return view('dashboard');
    }

    public function create() {
        return view('games.form');
    }

    public function store(CreateGameRequest $request): RedirectResponse
    {
//        $this->gameService->create($request->all())

        return redirect()->route('games.index');
    }

    public function show(Request $request): View
    {
        return view('games.show');
    }

    public function update(UpdateGameRequest $request, Game $game): RedirectResponse
    {
//        $this->gameService->update($game, $request->all())

        return redirect()->route('games.index');
    }

    public function destroy(Request $request, Game $game): RedirectResponse
    {
        try {
            $this->gameService->delete($game);
        } catch (Throwable $e) {
            Log::error($e);
        }

        return redirect()->route('games.index');
    }
}
