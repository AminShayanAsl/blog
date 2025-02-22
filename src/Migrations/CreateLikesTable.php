<?php

namespace App\Migrations;

use config\Database;

class CreateLikesTable {
    public function up() {
        $db = Database::getInstance();

        $query = "
            CREATE TABLE IF NOT EXISTS likes (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                post_id INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
                UNIQUE(user_id, post_id)
            );
        ";

        $db->exec($query);
    }

    public function down() {
        $db = Database::getInstance();
        $query = "DROP TABLE IF EXISTS likes;";
        $db->exec($query);
    }
}
