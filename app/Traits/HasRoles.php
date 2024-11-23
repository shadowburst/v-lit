<?php

namespace App\Traits;

use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Permission\Traits\HasRoles as SpatieHasRoles;

trait HasRoles
{
    use SpatieHasRoles;

    /**
     * Gets if the user is an admin.
     */
    protected function isAdmin(): Attribute
    {
        return Attribute::get(fn (): bool => $this->hasRole(RoleEnum::ADMIN));
    }

    /**
     * Gets if the user is a tester.
     */
    protected function isTester(): Attribute
    {
        return Attribute::get(fn (): bool => $this->hasRole(RoleEnum::TESTER));
    }

    /**
     * Gets if the user is a team admin.
     */
    protected function isTeamAdmin(): Attribute
    {
        return Attribute::get(fn (): bool => $this->hasRole(RoleEnum::TEAM_ADMIN));
    }

    /**
     * Gets if the user is a user.
     */
    protected function isUser(): Attribute
    {
        return Attribute::get(fn (): bool => $this->hasRole(RoleEnum::USER));
    }
}
