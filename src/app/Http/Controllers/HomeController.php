<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GameService;

class HomeController extends Controller
{
    public function __construct(
        protected GameService $gameService,
    )
    {
    }

    public function __invoke(Request $request)
    {
        return view('dashboard', [
            'currentlyPlaying' => $this->gameService->getCurrentlyPlaying($request->user()),
            'recentlyAdded' => $this->gameService->getRecentlyAdded($request->user()),
            'recentlyCompleted' => $this->gameService->getRecentlyCompleted($request->user()),
        ]);
    }
}
