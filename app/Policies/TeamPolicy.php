<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Team;
use App\Models\User;

class TeamPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::TEAMS_VIEW_ANY);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Team $team): bool
    {
        if (! $user->is_admin && $user->team()->isNot($team)) {
            return false;
        }

        return $user->hasPermissionTo(PermissionEnum::TEAMS_VIEW);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::TEAMS_CREATE);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Team $team): bool
    {
        if (! $user->is_admin && $user->team()->isNot($team)) {
            return false;
        }

        return $user->hasPermissionTo(PermissionEnum::TEAMS_UPDATE);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Team $team): bool
    {
        if ($user->team()->is($team) || $team->is_trashed) {
            return false;
        }

        return $user->hasPermissionTo(PermissionEnum::TEAMS_DELETE);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Team $team): bool
    {
        if ($user->team()->is($team) || ! $team->is_trashed) {
            return false;
        }

        return $user->hasPermissionTo(PermissionEnum::TEAMS_DELETE);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Team $team): bool
    {
        return $this->restore($user, $team);
    }
}
