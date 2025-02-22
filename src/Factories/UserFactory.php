<?php

namespace App\Factories;

use App\Models\User;

class UserFactory {
    public static function create($username, $roll, $password) {
        return new User($username, $roll, $password);
    }
}