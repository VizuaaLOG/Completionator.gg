<?php

namespace App\Http\Controllers;

use App\Services\GameService;

class HomeController extends Controller
{
    public function __construct(
        protected GameService $gameService,
    )
    {
    }

    public function __invoke()
    {
        return view('dashboard', [
            'currentlyPlaying' => $this->gameService->getCurrentlyPlaying(),
            'recentlyAdded' => $this->gameService->getRecentlyAdded(),
            'recentlyCompleted' => $this->gameService->getRecentlyCompleted(),
        ]);
    }
}
