<?php

namespace App\Factories;

use App\Models\NewsPost;
use App\Models\SciencePost;
use App\Models\SportsPost;
use Exception;

class PostFactory {
    public static function create($type, $title, $description, $author_id) {
        switch ($type) {
            case 'ورزشی':
                return new SportsPost($title, $description, $author_id);
            case 'خبری':
                return new NewsPost($title, $description, $author_id);
            case 'علمی':
                return new SciencePost($title, $description, $author_id);
            default:
                throw new Exception("Post type not specified.");
        }
    }
}