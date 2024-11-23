<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Scopes\TeamScope;
use App\Traits\BelongsToTeam;
use App\Traits\HasAuthorize;
use App\Traits\HasRoles;
use App\Traits\Trashable;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[ScopedBy([TeamScope::class])]
class User extends Authenticatable
{
    use BelongsToTeam, HasAuthorize, HasFactory, HasRoles, Notifiable, Trashable;

    protected $fillable = [
        'team_id',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Gets the model's teams.
     */
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }
}
