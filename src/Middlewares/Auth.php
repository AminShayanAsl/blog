<?php

namespace App\Middlewares;

class Auth
{
    public static function handle() {
        if (isset($_SESSION['user_id'])) {
            return true;
        }
        return false;
    }
}
