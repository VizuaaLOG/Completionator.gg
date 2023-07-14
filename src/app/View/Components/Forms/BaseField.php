<?php

namespace App\View\Components\Forms;

use Illuminate\Support\Str;
use Illuminate\View\ComponentSlot;
use Illuminate\View\Component;

abstract class BaseField extends Component
{
    public string $nameDot;

    public function __construct(
        public string $name,
        public string $label,
        public ComponentSlot $addon,
        public mixed $value = null
    )
    {
        $this->nameDot = Str::of($this->name)
            ->replace('[', '.')
            ->replace(']', '')
            ->rtrim('.')
            ->toString();
    }

    public function value(): mixed
    {
        return old($this->nameDot, $this->value);
    }
}
