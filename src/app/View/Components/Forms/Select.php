<?php

namespace App\View\Components\Forms;

use Illuminate\View\ComponentSlot;
use Illuminate\Contracts\View\View;

class Select extends BaseField
{
    public function __construct(
        public string $name,
        public string $label,
        public ComponentSlot $addon,
        public mixed $value = null,
        public array $options = [],
        public bool $multiple = false,
    )
    {
        parent::__construct($this->name, $this->label, $this->addon, $this->value);
    }

    public function value(): mixed
    {
        if($this->multiple) {
            return old($this->nameDot, $this->value ?? []);
        }

        return parent::value();
    }

    public function render(): View
    {
        return view('components.forms.select');
    }
}
