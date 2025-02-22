<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::getAll();
        $this->render('index', compact('posts'));
    }
}
