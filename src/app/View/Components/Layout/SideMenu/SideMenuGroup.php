<?php

namespace App\View\Components\Layout\SideMenu;

use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\URL;

class SideMenuGroup extends Component
{
    public string $route;

    public function __construct(
        public string $title,
        string $route,
        public string|null $badge = null,
        public Collection|null $children = null,
    )
    {
        $this->route = route($route);
    }

    public function active(): bool
    {
        return URL::current() === $this->route;
    }

    public function render(): View
    {
        return view('components.layout.side-menu.side-menu-group');
    }
}
