<?php

namespace App\Http\Transformers\Platforms;

use App\Models\Platform;
use League\Fractal\TransformerAbstract;

class PlatformTransformer extends TransformerAbstract
{
    public function transform(Platform $platform): array
    {
        return [
            'id'       => $platform->id,
            'name'     => $platform->name,
            'description' => $platform->description,
            'links'    => [
                'show'    => route('platforms.show', ['platform' => $platform]),
                'update'  => route('platforms.update', ['platform' => $platform]),
                'destroy' => route('platforms.destroy', ['platform' => $platform]),
            ],
        ];
    }
}
