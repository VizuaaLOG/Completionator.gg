<?php

namespace App\View\Composers;

use App\Services\PlatformService;
use Illuminate\Contracts\View\View;

class SideMenuComposer
{
    public function __construct(
        protected PlatformService $platformService
    ) {}

    public function compose(View $view): void
    {
        $view->with('platforms', $this->platformService->all());
    }
}
