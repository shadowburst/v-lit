<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Role;
use App\Models\User;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ROLES_VIEW_ANY);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role): bool
    {
        if (! $user->is_admin && $role->team_id && $user->team()->isNot($role->team_id)) {
            return false;
        }

        return $user->hasPermissionTo(PermissionEnum::ROLES_VIEW);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ROLES_CREATE);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role): bool
    {
        if (! $user->is_admin && $user->team()->isNot($role->team_id)) {
            return false;
        }

        return $user->hasPermissionTo(PermissionEnum::ROLES_UPDATE);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role): bool
    {
        if (! $user->is_admin && $user->team()->isNot($role->team_id)) {
            return false;
        }

        return $role->users()->count() === 0 && $user->hasPermissionTo(PermissionEnum::ROLES_DELETE);
    }
}
