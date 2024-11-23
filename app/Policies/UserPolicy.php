<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::USERS_VIEW_ANY);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        if ($user->is($model)) {
            return true;
        }

        if (! $user->is_admin && $user->team()->isNot($model->team_id)) {
            return false;
        }

        return $user->hasPermissionTo(PermissionEnum::USERS_VIEW);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::USERS_CREATE);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        if ($user->is($model)) {
            return true;
        }

        if (! $user->is_admin && $user->team()->isNot($model->team_id)) {
            return false;
        }

        return $user->hasPermissionTo(PermissionEnum::USERS_UPDATE);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        if ($user->is($model) || $model->is_trashed) {
            return false;
        }

        if (! $user->is_admin && $user->team()->isNot($model->team_id)) {
            return false;
        }

        return $user->hasPermissionTo(PermissionEnum::USERS_DELETE);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        if ($user->is($model) || ! $model->is_trashed) {
            return false;
        }

        if (! $user->is_admin && $user->team()->isNot($model->team_id)) {
            return false;
        }

        return $user->hasPermissionTo(PermissionEnum::USERS_DELETE);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $this->restore($user, $model);
    }
}
