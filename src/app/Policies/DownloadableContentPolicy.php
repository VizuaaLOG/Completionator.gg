<?php

namespace App\Policies;

use App\Models\DownloadableContent;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DownloadableContentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, DownloadableContent $downloadableContent): bool
    {
        return $downloadableContent->game->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, DownloadableContent $downloadableContent): bool
    {
        return $downloadableContent->game->user_id === $user->id;
    }

    public function delete(User $user, DownloadableContent $downloadableContent): bool
    {
        return $downloadableContent->game->user_id === $user->id;
    }

    public function restore(User $user, DownloadableContent $downloadableContent): bool
    {
        return $downloadableContent->game->user_id === $user->id;
    }

    public function forceDelete(User $user, DownloadableContent $downloadableContent): bool
    {
        return $downloadableContent->game->user_id === $user->id;
    }
}
