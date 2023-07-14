<?php

namespace App\View\Components\Forms;

use Illuminate\Contracts\View\View;

class Input extends BaseField
{
    public function render(): View
    {
        return view('components.forms.input');
    }
}
