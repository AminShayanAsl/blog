<?php

use App\Factories\PostFactory;
use App\Factories\UserFactory;
use App\Models\Post;
use App\Models\User;
use config\Database;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase {

    protected $db;

    protected function setUp(): void {
        $this->db = Database::getInstance();
        $this->db->exec("DELETE FROM users");
        $this->db->exec("DELETE FROM posts");
        $this->db->exec("DELETE FROM likes");
    }

    public function testSportsPostCanBeCreated() {
        $user = UserFactory::create('Ali', 'user', 'password123');
        $user->save();
        $post = PostFactory::create('ورزشی', 'عنوان مقاله', 'توضیح کوتاه مقاله', User::getByUsername('Ali')['id']);
        $post->save();

        $stmt = $this->db->query("SELECT * FROM posts WHERE title = 'عنوان مقاله'");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotEmpty($result);
        $this->assertEquals('عنوان مقاله', $result['title']);
        $this->assertEquals('ورزشی', $result['category']);
        $this->assertEquals('توضیح کوتاه مقاله', $result['description']);
    }

    public function testNewsPostCanBeCreated() {
        $user = UserFactory::create('Ali', 'user', 'password123');
        $user->save();
        $post = PostFactory::create('خبری', 'عنوان مقاله', 'توضیح کوتاه مقاله', User::getByUsername('Ali')['id']);
        $post->save();

        $stmt = $this->db->query("SELECT * FROM posts WHERE title = 'عنوان مقاله'");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotEmpty($result);
        $this->assertEquals('عنوان مقاله', $result['title']);
        $this->assertEquals('خبری', $result['category']);
        $this->assertEquals('توضیح کوتاه مقاله', $result['description']);
    }

    public function testSciencePostCanBeCreated() {
        $user = UserFactory::create('Ali', 'user', 'password123');
        $user->save();
        $post = PostFactory::create('علمی', 'عنوان مقاله', 'توضیح کوتاه مقاله', User::getByUsername('Ali')['id']);
        $post->save();

        $stmt = $this->db->query("SELECT * FROM posts WHERE title = 'عنوان مقاله'");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotEmpty($result);
        $this->assertEquals('عنوان مقاله', $result['title']);
        $this->assertEquals('علمی', $result['category']);
        $this->assertEquals('توضیح کوتاه مقاله', $result['description']);
    }

    public function testPostCanBeLiked() {
        $user = UserFactory::create('Ali', 'user', 'password123');
        $user->save();
        $user_id = User::getByUsername('Ali')['id'];
        $post = PostFactory::create('ورزشی', 'عنوان مقاله', 'توضیح کوتاه مقاله', $user_id);
        $post->save();
        $post_id = Post::getByTitle('عنوان مقاله')['id'];

        $post->like($user_id);

        $stmt = $this->db->query("SELECT COUNT(*) FROM likes WHERE post_id = " . $post_id . " AND user_id = " . $user_id);
        $result = $stmt->fetchColumn();

        $this->assertEquals(1, $result);
    }

    public function testGetLikesCount() {
        $first_user = UserFactory::create('Ali', 'user', 'password123');
        $first_user->save();
        $first_user_id = User::getByUsername('Ali')['id'];
        $second_user = UserFactory::create('Amin', 'user', 'password123');
        $second_user->save();
        $second_user_id = User::getByUsername('Amin')['id'];
        $post = PostFactory::create('ورزشی', 'عنوان مقاله', 'توضیح کوتاه مقاله', $first_user_id);
        $post->save();
        $post_id = Post::getByTitle('عنوان مقاله')['id'];

        $post->like($first_user_id);
        $post->like($second_user_id);

        $likesCount = $post->getLikesCount();

        $this->assertEquals(2, $likesCount);
    }

    protected function tearDown(): void {
        $this->db->exec("DELETE FROM users");
        $this->db->exec("DELETE FROM posts");
        $this->db->exec("DELETE FROM likes");
    }
}
