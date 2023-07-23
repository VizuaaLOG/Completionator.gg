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
use App\Models\DownloadableContent;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Services\DownloadableContentService;
use App\Http\Requests\Games\CreateDownloadableContentRequest;
use App\Http\Requests\Games\UpdateDownloadableContentRequest;

class DownloadableContentController extends Controller
{
    public function __construct(
        protected readonly GameService $gameService,
        protected readonly DownloadableContentService $downloadableContentService,
        protected readonly PlatformService $platformService,
        protected readonly StorefrontService $storefrontService,
        protected readonly CompanyService $companyService,
        protected readonly GenreService $genreService,
    )
    {
        $this->authorizeResource(DownloadableContent::class, 'downloadable_content');
    }

    public function create(Request $request, Game $game) {
        return view('downloadable_content.form', [
            'game' => $game,
            'platforms' => $this->platformService->allForDropdown($request->user()),
            'storefronts' => $this->storefrontService->allForDropdown($request->user()),
            'statuses' => $this->gameService->statusesForDropdown(),
            'priorities' => $this->gameService->prioritiesForDropdown(),
            'companies' => $this->companyService->getForDropdown(),
            'genres' => $this->genreService->getForDropdown(),
        ]);
    }

    public function store(CreateDownloadableContentRequest $request, Game $game): RedirectResponse
    {
        try {
            $this->downloadableContentService->create($game, $request->all());

            return redirect()
                ->route('downloadable_content.index')
                ->with('success', "Downloadable content \"{$request->get('name')}\" has been created.");
        } catch(Throwable $e) {
            Log::error($e);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'message' => 'Error occurred while creating the downloadable content. Try again, or check the logs if this persists.',
                ]);
        }
    }

    public function show(Game $game, DownloadableContent $downloadableContent): View
    {
        if($downloadableContent->game_id !== $game->id) {
            abort(404);
        }

        return view('downloadable_content.show', [
            'game' => $game,
            'dlc' => $downloadableContent,
        ]);
    }

    public function edit(Request $request, Game $game, DownloadableContent $downloadableContent) {
        if($downloadableContent->game_id !== $game->id) {
            abort(404);
        }

        return view('downloadable_content.form', [
            'dlc' => $downloadableContent,
            'game' => $game,
            'platforms' => $this->platformService->allForDropdown($request->user()),
            'storefronts' => $this->storefrontService->allForDropdown($request->user()),
            'statuses' => $this->gameService->statusesForDropdown(),
            'priorities' => $this->gameService->prioritiesForDropdown(),
            'companies' => $this->companyService->getForDropdown(),
            'genres' => $this->genreService->getForDropdown(),
        ]);
    }

    public function update(UpdateDownloadableContentRequest $request, Game $game, DownloadableContent $downloadableContent): RedirectResponse
    {
        if($downloadableContent->game_id !== $game->id) {
            abort(404);
        }

        try {
            $this->downloadableContentService->update($downloadableContent, $request->all());

            return redirect()
                ->route('downloadable_content.show', ['downloadableContent' => $downloadableContent])
                ->with('success', "Downloadable content updated.");
        } catch(Throwable $e) {
            Log::error($e);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'message' => 'Error occurred while updating the downloadable content. Try again, or check the logs if this persists.',
                ]);
        }
    }

    public function destroy(Request $request, Game $game, DownloadableContent $downloadableContent): RedirectResponse
    {
        if($downloadableContent->game_id !== $game->id) {
            abort(404);
        }

        try {
            $this->downloadableContentService->delete($downloadableContent);
        } catch (Throwable $e) {
            Log::error($e);
        }

        return redirect()->route('games.show', ['game' => $downloadableContent->game_id]);
    }
}
