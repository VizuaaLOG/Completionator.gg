<?php

namespace App\Http\Controllers\Games;

use Log;
use Throwable;
use App\Models\Game;
use Illuminate\Http\Request;
use App\Services\GameService;
use App\Services\GenreService;
use App\Services\CompanyService;
use App\Services\PlatformService;
use Illuminate\Contracts\View\View;
use App\Services\StorefrontService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Games\CreateGameRequest;
use App\Http\Requests\Games\UpdateGameRequest;

class GameController extends Controller
{
    public function __construct(
        protected readonly GameService $gameService,
        protected readonly PlatformService $platformService,
        protected readonly StorefrontService $storefrontService,
        protected readonly CompanyService $companyService,
        protected readonly GenreService $genreService,
    )
    {
        $this->authorizeResource(Game::class, 'game');
    }

    public function index(Request $request): View
    {
        return view('games.index', [
            'games' => $this->gameService->paginated($request->user()),
        ]);
    }

    public function create() {
        return view('games.form', [
            'platforms' => $this->platformService->allForDropdown(),
            'storefronts' => $this->storefrontService->allForDropdown(),
            'statuses' => $this->gameService->statusesForDropdown(),
            'priorities' => $this->gameService->prioritiesForDropdown(),
            'companies' => $this->companyService->getForDropdown(),
            'genres' => $this->genreService->getForDropdown(),
        ]);
    }

    public function store(CreateGameRequest $request): RedirectResponse
    {
        try {
            $this->gameService->create($request->user(), $request->all());

            return redirect()
                ->route('games.index')
                ->with('success', "Game \"{$request->get('name')}\" has been created.");
        } catch(Throwable $e) {
            Log::error($e);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'message' => 'Error occurred while creating the game. Try again, or check the logs if this persists.',
                ]);
        }
    }

    public function show(Game $game): View
    {
        return view('games.show', [
            'game' => $game,
        ]);
    }

    public function edit(Game $game) {
        return view('games.form', [
            'game' => $game,
            'platforms' => $this->platformService->allForDropdown(),
            'storefronts' => $this->storefrontService->allForDropdown(),
            'statuses' => $this->gameService->statusesForDropdown(),
            'priorities' => $this->gameService->prioritiesForDropdown(),
            'companies' => $this->companyService->getForDropdown(),
            'genres' => $this->genreService->getForDropdown(),
        ]);
    }

    public function update(UpdateGameRequest $request, Game $game): RedirectResponse
    {
        try {
            $this->gameService->update($game, $request->all());

            return redirect()
                ->route('games.show', ['game' => $game])
                ->with('success', "Game updated.");
        } catch(Throwable $e) {
            Log::error($e);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'message' => 'Error occurred while updating the game. Try again, or check the logs if this persists.',
                ]);
        }
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
