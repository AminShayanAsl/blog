<?php

namespace App\Migrations;

use config\Database;

class CreateUsersTable {
    public function up() {
        $db = Database::getInstance();

        $query = "
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(255) UNIQUE NOT NULL,
                roll ENUM('super_admin', 'admin', 'user') NOT NULL,
                password VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            );
        ";

        $db->exec($query);
    }

    public function down() {
        $db = Database::getInstance();
        $query = "DROP TABLE IF EXISTS users;";
        $db->exec($query);
    }
}