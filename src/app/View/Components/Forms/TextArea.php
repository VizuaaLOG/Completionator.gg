<?php

namespace App\View\Components\Forms;

use Illuminate\Contracts\View\View;

class TextArea extends BaseField
{
    public function render(): View
    {
        return view('components.forms.text-area');
    }
}
