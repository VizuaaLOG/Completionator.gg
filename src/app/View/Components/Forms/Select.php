<?php

namespace App\View\Components\Forms;

use Illuminate\View\ComponentSlot;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Contracts\View\View;

class Select extends BaseField
{
    public function __construct(
        public string                  $name,
        public string                  $label,
        public ComponentSlot           $addon,
        public mixed                   $value = null,
        public array|SupportCollection $options = [],
        public bool                    $multiple = false,
    )
    {
        parent::__construct($this->name, $this->label, $this->addon, $this->value);

        if(is_array($options)) {
            $this->options = collect($options);
        }

        if(is_array($value)) {
            $this->value = collect($value);
        } else if(empty($value) && $this->multiple) {
            $this->value = collect();
        }
    }

    public function value(): mixed
    {
        if($this->multiple) {
            $old = old($this->nameDot, $this->value ?? []);
            if(is_array($old)) {
                $old = collect($old);
            }

            return $old;
        }

        return parent::value();
    }

    public function render(): View
    {
        return view('components.forms.select');
    }
}
