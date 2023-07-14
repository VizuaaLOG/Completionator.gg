<?php

namespace App\Enums\Components;

use Str;

enum AlertType {
    case Danger;
    case Info;
    case Warning;
    case Success;

    public function __call(string $name, array $arguments) {
        if(Str::startsWith($name, 'is')) {
            $type = Str::replace('is', '', $name);
            $constant = constant("self::$type");
            return $this instanceof $constant;
        }
    }
}
