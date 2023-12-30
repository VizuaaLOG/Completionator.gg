<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];
    protected $hidden = [
        'password',
    ];

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'user_role_id');
    }

    public function isAdmin(): bool
    {
        return $this->user_role_id === Role::ADMIN;
    }
}
