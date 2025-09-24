<?php

namespace Config;

use Myth\Auth\Config\Auth as MythAuth;

class Auth extends MythAuth
{
    /**
     * Override tabel bawaan Myth/Auth
     */
    public $tables = [
        'users'              => 'm_users',
        'groups'             => 'm_groups',
        'users_groups'       => 'm_users_groups',
        'permissions'        => 'm_permissions',
        'groups_permissions' => 'm_groups_permissions',
        'login_attempts'     => 'm_logins',
        'remember_tokens'    => 'm_tokens',
    ];
}
