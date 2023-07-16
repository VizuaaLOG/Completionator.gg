<?php

namespace App\View\Components\Storefronts;

use App\Models\Storefront;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardHorizontal extends Component
{
    public function __construct(
        public Storefront $storefront,
    )
    {}

    public function render(): View
    {
        return view('components.storefronts.card-horizontal');
    }
}
