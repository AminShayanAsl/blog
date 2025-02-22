<?php

namespace App\Controllers;

use App\Controller;
use App\Factories\LikeFactory;
use App\Factories\PostFactory;
use App\Models\Post;

class PostController extends Controller
{
    public function createPost()
    {
        $title = $_POST['title'];
        $category = $_POST['category'];
        $description = $_POST['description'];

        $post = PostFactory::create($category, $title, $description, $_SESSION['user_id']);
        $post->save();
        $this->flushMessage('پست جدید ایجاد شد.', 'success');
        $userController = new UserController();
        $userController->dashboard();
    }

    public function like()
    {
        if (isset($_SESSION['user_id'])) {
            $post_id = $_GET['id'];
            $user_id = $_SESSION['user_id'];

            $like = LikeFactory::create($user_id, $post_id);
            $like->save();
            $this->flushMessage('شما مقاله‌ای را پسندید.', 'success');
        }
        else
            $this->flushMessage('لطفا ابتدا وارد حساب کاربری خود شوید.', 'warning');
        $homeController = new HomeController();
        $homeController->index();
    }
}