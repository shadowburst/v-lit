<?php

namespace App\Models;

use App\Models\Scopes\TeamScope;
use App\Traits\BelongsToTeam;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Spatie\Permission\Models\Role as SpatieRole;

#[ScopedBy([TeamScope::class])]
class Role extends SpatieRole
{
    use BelongsToTeam;
}
