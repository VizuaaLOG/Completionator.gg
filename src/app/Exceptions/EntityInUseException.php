<?php

namespace App\Exceptions;

use Log;
use Exception;
use Throwable;
use Illuminate\Database\Eloquent\Model;

class EntityInUseException extends Exception
{
    public Model $entity;

    public function __construct(
        string     $message = "Error while processing the delete. This entity is in use.",
        int        $code = 0,
        ?Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }

    public static function withEntity(Model $entity): self
    {
        $exception = new self();
        $exception->entity = $entity;

        return $exception;
    }

    public function report(): void
    {
        Log::error($this, ['entity' => $this->entity]);
    }
}
