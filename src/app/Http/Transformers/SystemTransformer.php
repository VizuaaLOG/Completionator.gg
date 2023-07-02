<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;

class SystemTransformer extends TransformerAbstract
{
    public function transform(array $settings): array
    {
        return $settings;
    }
}
