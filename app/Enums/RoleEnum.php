<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case TESTER = 'tester';
    case TEAM_ADMIN = 'team_admin';
    case USER = 'user';
}
