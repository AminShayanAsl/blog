<?php

namespace App\Models;

use config\Database;
use PDO;

class User {
    private $id;
    private $username;
    private $roll;
    private $password;

    public function __construct($username, $roll, $password) {
        $this->username = $username;
        $this->roll = $roll;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function save() {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO users (username, roll, password) VALUES (?, ?, ?)");
        $stmt->execute([$this->username, $this->roll, $this->password]);
    }

    public static function getById($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByUsername($username) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function login($username, $password) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_username'] = $user['username'];
        $_SESSION['user_roll'] = $user['roll'];

        return true;
    }

    public static function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_username']);
        unset($_SESSION['user_roll']);
    }

    public static function getLikes($user_id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM likes WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getPosts($user_id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM posts WHERE author_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAll() {
        $db = Database::getInstance();
        $sql = "SELECT * FROM users ORDER BY created_at DESC";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}