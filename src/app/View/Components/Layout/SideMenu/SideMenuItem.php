<?php

namespace App\View\Components\Layout\SideMenu;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\URL;

class SideMenuItem extends Component
{
    public function __construct(
        public string $title,
        public string $route,
        public string|null $badge = null,
    )
    {}

    public function active(): bool
    {
        return URL::current() === $this->route;
    }

    public function render(): View
    {
        return view('components.layout.side-menu.side-menu-item');
    }
}
