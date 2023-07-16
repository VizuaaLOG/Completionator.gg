<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\View\ComponentSlot;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Model;

class ImageUpload extends BaseField
{
    public function __construct(
        string $name,
        string $label,
        ComponentSlot $addon,
        public string $collection,
        public string|null $conversion = null,
        public Model|null $entity = null,
        mixed $value = null
    )
    {
        parent::__construct($name, $label, $addon, $value);
    }

    public function render(): View
    {
        return view('components.forms.image-upload');
    }
}
