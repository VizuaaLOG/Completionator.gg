<?php

namespace App\Http\Transformers\Users;

use App\Models\Role;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract
{
    public function transform(Role $role): array
    {
        return [
            'id'     => $role->id,
            'name'   => $role->name,
            'system' => true,
        ];
    }
}
