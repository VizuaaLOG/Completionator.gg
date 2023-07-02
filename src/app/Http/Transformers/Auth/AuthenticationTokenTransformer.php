<?php

namespace App\Http\Transformers\Auth;

use Laravel\Sanctum\NewAccessToken;
use League\Fractal\TransformerAbstract;

class AuthenticationTokenTransformer extends TransformerAbstract
{
    public function transform(NewAccessToken $token): array
    {
        return [
            'access_token' => $token->plainTextToken,
        ];
    }
}
