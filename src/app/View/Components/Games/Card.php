<?php

namespace App\View\Components\Games;

use App\Models\Game;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public function __construct(
        public Game $game,
    )
    {}

    public function render(): View
    {
        return view('components.games.card');
    }
}
