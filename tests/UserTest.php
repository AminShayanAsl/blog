<?php

use App\Factories\UserFactory;
use App\Models\User;
use config\Database;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {

    protected $db;

    protected function setUp(): void {
        $this->db = Database::getInstance();
        $this->db->exec("DELETE FROM users");
    }

    public function testUserCanBeCreated() {
        $user = UserFactory::create('Ali', 'user', 'password123');
        $user->save();

        $stmt = $this->db->query("SELECT * FROM users WHERE username = 'Ali'");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotEmpty($result);
        $this->assertEquals('Ali', $result['username']);
        $this->assertEquals('user', $result['roll']);
    }

    public function testUserCanLogin() {
        $user = UserFactory::create('Ali', 'user', 'password123');
        $user->save();

        $loggedInUser = User::login('Ali', 'password123');

        $this->assertNotNull($loggedInUser);
        $this->assertTrue($loggedInUser);
    }

    protected function tearDown(): void {
        $this->db->exec("DELETE FROM users");
    }
}
