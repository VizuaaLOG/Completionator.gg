<?php

namespace App\Policies;

use App\Models\Game;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GamePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Game $game): bool
    {
        return $game->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Game $game): bool
    {
        return $game->user_id === $user->id;
    }

    public function delete(User $user, Game $game): bool
    {
        return $game->user_id === $user->id;
    }

    public function restore(User $user, Game $game): bool
    {
        return $game->user_id === $user->id;
    }

    public function forceDelete(User $user, Game $game): bool
    {
        return $game->user_id === $user->id;
    }
}
