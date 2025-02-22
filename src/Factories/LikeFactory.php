<?php

namespace App\Factories;

use App\Models\Like;

class LikeFactory
{
    public static function create($user_id, $post_id) {
        return new Like($user_id, $post_id);
    }
}