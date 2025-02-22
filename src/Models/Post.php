<?php

namespace App\Models;

use config\Database;
use PDO;

class Post {
    protected $id;
    protected $title;
    protected $category;
    protected $description;
    protected $created_at;
    protected $updated_at;
    protected $author_id;

    public function __construct($title, $description, $author_id) {
        $this->title = $title;
        $this->description = $description;
        $this->author_id = $author_id;
    }

    public static function getLikesCount($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT COUNT(*) FROM likes WHERE post_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }

    public static function getById($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByTitle($title) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM posts WHERE title = ?");
        $stmt->execute([$title]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAll() {
        $db = Database::getInstance();
        $sql = "SELECT * FROM posts ORDER BY created_at DESC";
        $stmt = $db->query($sql);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $posts;
    }

    public function getAuthor() {
        return User::getById($this->author_id);
    }
}
