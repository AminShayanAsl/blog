<?php

namespace App\Models;

use config\Database;

class SportsPost extends Post {
    public function __construct($title, $description, $author_id) {
        parent::__construct($title, $description, $author_id);
        $this->category = 'ورزشی';
    }

    public function save() {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO posts (title, category, description, author_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->title, $this->category, $this->description, $this->author_id]);
        $this->id = $db->lastInsertId();
    }
}
