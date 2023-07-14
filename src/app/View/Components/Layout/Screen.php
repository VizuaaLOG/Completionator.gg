<?php

namespace App\View\Components\Layout;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Screen extends Component
{
    public function __construct(
        public string|null $title = null,
    )
    {}

    public function render(): View
    {
        return view('components.layout.screen');
    }
}
