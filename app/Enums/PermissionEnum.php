<?php

namespace App\Enums;

enum PermissionEnum: string
{
    case TEAMS = 'teams.*';
    case TEAMS_VIEW_ANY = 'teams.view_any';
    case TEAMS_VIEW = 'teams.view';
    case TEAMS_CREATE = 'teams.create';
    case TEAMS_UPDATE = 'teams.update';
    case TEAMS_DELETE = 'teams.delete';

    case USERS = 'users.*';
    case USERS_VIEW_ANY = 'users.view_any';
    case USERS_VIEW = 'users.view';
    case USERS_CREATE = 'users.create';
    case USERS_UPDATE = 'users.update';
    case USERS_DELETE = 'users.delete';

    case ROLES = 'roles.*';
    case ROLES_VIEW_ANY = 'roles.view_any';
    case ROLES_VIEW = 'roles.view';
    case ROLES_CREATE = 'roles.create';
    case ROLES_UPDATE = 'roles.update';
    case ROLES_DELETE = 'roles.delete';
}
