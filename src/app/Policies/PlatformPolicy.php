<?php

namespace App\Policies;

use App\Models\Platform;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlatformPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Platform $platform): bool
    {
        return $platform->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Platform $platform): bool
    {
        return $platform->user_id === $user->id;
    }

    public function delete(User $user, Platform $platform): bool
    {
        return $platform->user_id === $user->id;
    }

    public function restore(User $user, Platform $platform): bool
    {
        return $platform->user_id === $user->id;
    }

    public function forceDelete(User $user, Platform $platform): bool
    {
        return $platform->user_id === $user->id;
    }
}
