<?php

namespace App\View\Components\Layout\SideMenu;

use App\Models\Platform;
use App\Models\Storefront;
use App\Services\PlatformService;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Services\StorefrontService;

class SideMenu extends Component
{
    public function __construct(
        protected PlatformService $platformService,
        protected StorefrontService $storefrontService,
    )
    {}

    public function platforms(): Collection
    {
        return $this
            ->platformService
            ->all(['games'])
            ->map(function(Platform $platform) {
                return (object) [
                    'title' => $platform->name,
                    'route' => route('platforms.show', ['platform' => $platform]),
                    'badge' => $platform->games_count,
                ];
            });
    }

    public function storefronts(): Collection
    {
        return $this
            ->storefrontService
            ->all()
            ->map(function(Storefront $storefront) {
                return (object) [
                    'title' => $storefront->name,
                    'route' => route('storefronts.show', ['storefront' => $storefront]),
                    'badge' => $storefront->games_count,
                ];
            });
    }

    public function render(): View
    {
        return view('components.layout.side-menu.side-menu');
    }
}
