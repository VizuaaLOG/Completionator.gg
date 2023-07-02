<?php

namespace App\Http\Transformers;

use Throwable;
use League\Fractal\TransformerAbstract;

class ExceptionTransformer extends TransformerAbstract
{
    public function transform(Throwable $exception): array
    {
        return [
            'exception' => class_basename($exception),
            'message'   => $exception->getMessage(),
            'code'      => $exception->getCode(),
            'logged'    => true,
        ];
    }
}
