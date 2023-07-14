<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Enums\Components\AlertType;

class Alert extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public AlertType $type = AlertType::Info,
        public string $message = '',
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
