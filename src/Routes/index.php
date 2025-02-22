<?php

use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\UserController;
use App\Middlewares\Auth;
use App\Middlewares\HighThanAdmin;
use App\Middlewares\SuperAdmin;
use App\Router;

$router = new Router();
$auth = new Auth();
$superAdmin = new SuperAdmin();

$router->get('/', HomeController::class, 'index');
$router->get('/login', UserController::class, 'login');
$router->get('/logout', UserController::class, 'logout');
$router->get('/signup', UserController::class, 'signup');
$router->get('/signup', UserController::class, 'signup');
$router->get('/dashboard', UserController::class, 'dashboard')->addMiddleware($auth);
$router->get('/like', PostController::class, 'like');
$router->post('/signup', UserController::class, 'createAccount');
$router->post('/login', UserController::class, 'loginAccount');
$router->post('/post', PostController::class, 'createPost');

$router->dispatch();
