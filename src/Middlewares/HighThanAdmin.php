<?php

namespace App\Middlewares;

class HighThanAdmin
{
    public static function handle() {
        if (isset($_SESSION['user_roll']) && ($_SESSION['user_roll'] == 'admin' || $_SESSION['user_roll'] == 'super_admin')) {
            return true;
        }
        return false;
    }
}
