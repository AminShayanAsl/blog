<?php

namespace App\Models;

use config\Database;

class Like
{
    private  $user_id;
    private  $post_id;
    public function __construct($user_id, $post_id) {
        $this->user_id = $user_id;
        $this->post_id = $post_id;
    }

    public function save() {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT IGNORE INTO likes (user_id, post_id) VALUES (?, ?)");
        $stmt->execute([$this->user_id, $this->post_id]);
    }
}