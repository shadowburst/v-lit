<?php

namespace App\Traits;

use App\Models\Team;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToTeam
{
    /**
     * Boot the BelongsToTeam trait for a class.
     */
    public static function bootBelongsToTeam(): void {}

    /**
     * Initialize the BelongsToTeam trait for an instance.
     */
    public function initializeBelongsToTeam(): void {}

    /**
     * Gets the key for the team id column.
     */
    protected function getTeamIdKey(): string
    {
        return 'team_id';
    }

    /**
     * Gets the model's team.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, $this->getTeamIdKey());
    }
}
