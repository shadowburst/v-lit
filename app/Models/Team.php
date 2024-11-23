<?php

namespace App\Models;

use App\Traits\Trashable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use Trashable;

    protected $fillable = [
        'name',
        'users_limit',
    ];

    /**
     * Gets the team's users.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
