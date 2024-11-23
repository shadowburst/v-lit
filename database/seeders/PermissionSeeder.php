<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artisan::call('permission:cache-reset'); // Needed to forget old permissions
        foreach (PermissionEnum::cases() as $case) {
            Permission::findOrCreate($case->value);
        }
        Artisan::call('permission:cache-reset'); // Needed to get new permissions

        foreach (RoleEnum::cases() as $case) {
            /** @var \App\Models\Role $role */
            $role = Role::findOrCreate($case->value);

            $permissions = array_filter(
                PermissionEnum::cases(),
                function (PermissionEnum $permission) use ($case): bool {
                    if ($case === RoleEnum::ADMIN) {
                        return true;
                    }

                    if ($case === RoleEnum::TESTER) {
                        return true;
                    }

                    if ($case === RoleEnum::TEAM_MANAGER) {
                        return ! in_array($permission, [
                            PermissionEnum::TEAMS,
                            PermissionEnum::TEAMS_VIEW_ANY,
                            PermissionEnum::TEAMS_VIEW,
                            PermissionEnum::TEAMS_CREATE,
                            PermissionEnum::TEAMS_DELETE,
                        ]);
                    }

                    if ($case === RoleEnum::USER) {
                        return in_array($permission, [
                            PermissionEnum::USERS_UPDATE,
                        ]);
                    }

                    return false;
                }
            );

            $role->givePermissionTo($permissions);
        }
    }
}
