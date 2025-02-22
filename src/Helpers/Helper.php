<?php

namespace App\Helpers;

class Helper
{
    public static function isAdmin()
    {
        if (isset($_SESSION['user_roll']) && $_SESSION['user_roll'] == 'admin')
            return true;
        return false;
    }

    public static function isSuperAdmin()
    {
        if (isset($_SESSION['user_roll']) && $_SESSION['user_roll'] == 'super_admin')
            return true;
        return false;
    }

    public static function highThanAdmin()
    {
        return self::isAdmin() || self::isSuperAdmin();
    }

}