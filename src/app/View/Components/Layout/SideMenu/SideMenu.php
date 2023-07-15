<?php

namespace App\View\Components\Layout\SideMenu;

use App\Models\Platform;
use App\Services\PlatformService;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideMenu extends Component
{
    public function __construct(
        protected PlatformService $platformService,
    )
    {}

    public function platforms(): Collection
    {
        return $this
            ->platformService
            ->all()
            ->map(function(Platform $platform) {
                return (object) [
                    'title' => $platform->name,
                    'route' => route('platforms.show', ['platform' => $platform]),
                    'badge' => '12',
                ];
            });
    }

    public function render(): View
    {
        return view('components.layout.side-menu.side-menu');
    }
}
