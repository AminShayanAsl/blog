<?php

namespace App\Middlewares;

class SuperAdmin
{
    public static function handle() {
        if (isset($_SESSION['user_roll']) && $_SESSION['user_roll'] == 'super_admin') {
            return true;
        }
        return false;
    }
}