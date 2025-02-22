<?php

namespace App\Models;

use config\Database;

class SciencePost extends Post {
    public function __construct($title, $description, $author_id) {
        parent::__construct($title, $description, $author_id);
        $this->category = 'علمی';
    }

    public function save() {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO posts (title, category, description, author_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->title, $this->category, $this->description, $this->author_id]);
        $this->id = $db->lastInsertId();
    }
}
