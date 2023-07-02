<?php

namespace App\Services;

use Hash;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function getUserUsingCredentials(string $email, string $password): User
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user;
    }

    public function logout(User $user): bool
    {
        // Delete the user's current access token being used for this session
        /** @var PersonalAccessToken $token */
        $token = $user->currentAccessToken();
        return $token->delete();
    }
}
