<?php

namespace App\View\Components\Games;

use App\Models\Game;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\DownloadableContent;

class Dlc extends Component
{
    public function __construct(
        public Game $game,
        public DownloadableContent $dlc,
    )
    {}

    public function render(): View
    {
        return view('components.games.dlc');
    }
}
