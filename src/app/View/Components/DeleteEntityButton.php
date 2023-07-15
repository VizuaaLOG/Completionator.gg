<?php

namespace App\View\Components;

use Str;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteEntityButton extends Component
{
    public string $uniqId;

    public function __construct(
        public string $route,
    )
    {
        $this->uniqId = Str::uuid();
    }

    public function render(): View
    {
        return view('components.delete-entity-button');
    }
}
