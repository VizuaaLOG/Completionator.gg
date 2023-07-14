<?php

namespace App\View\Components\Forms;

use Illuminate\Contracts\View\View;

class DateInput extends BaseField
{
    public function render(): View
    {
        return view('components.forms.date-input');
    }
}
