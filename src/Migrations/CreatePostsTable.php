<?php

namespace App\Migrations;

use config\Database;

class CreatePostsTable {
    public function up() {
        $db = Database::getInstance();

        $query = "
            CREATE TABLE IF NOT EXISTS posts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                category VARCHAR(255) NOT NULL,
                description TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                author_id INT NOT NULL,
                FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE
            );
        ";

        $db->exec($query);
    }

    public function down() {
        $db = Database::getInstance();
        $query = "DROP TABLE IF EXISTS posts;";
        $db->exec($query);
    }
}
