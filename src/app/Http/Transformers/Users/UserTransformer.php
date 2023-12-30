<?php

namespace App\Http\Transformers\Users;

use App\Models\User;
use App\Models\Role;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'role',
    ];

    public function transform(User $user): array
    {
        return [
            'id'       => $user->id,
            'name'     => $user->name,
            'email'    => $user->email,
            'role_id'  => $user->role_id,
            'is_admin' => $user->role_id === Role::ADMIN,
            'links'    => [
                'show'    => route('users.show', ['user' => $user]),
                'update'  => route('users.update', ['user' => $user]),
                'destroy' => route('users.destroy', ['user' => $user]),
            ],
        ];
    }

    public function includeRole(User $user): Item
    {
        return $this->item($user->role, new RoleTransformer);
    }
}
