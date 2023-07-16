<?php

namespace App\View\Components\Platforms;

use App\Models\Platform;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardHorizontal extends Component
{
    public function __construct(
        public Platform $platform
    )
    {}

    public function render(): View
    {
        return view('components.platforms.card-horizontal');
    }
}
