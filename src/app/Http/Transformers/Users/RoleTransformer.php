<?php

namespace App\Http\Transformers\Users;

use App\Models\UserRole;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract
{
    public function transform(UserRole $role): array
    {
        return [
            'id'     => $role->id,
            'name'   => $role->name,
            'system' => true,
        ];
    }
}
