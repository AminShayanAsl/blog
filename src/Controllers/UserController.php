<?php

namespace App\Controllers;

use App\Controller;
use App\Factories\UserFactory;
use App\Helpers\Helper;
use App\Models\User;

class UserController extends Controller
{
    public function login()
    {
        if (isset($_SESSION['user_id']))
            $this->dashboard();
        else
            $this->render('login');
    }
    public function logout()
    {
        if (isset($_SESSION['user_id'])) {
            User::logout();
        }
        $home = new HomeController();
        $home->index();
    }

    public function signup()
    {
        if (isset($_SESSION['user_id']))
            $this->dashboard();
        else
            $this->render('signup');
    }

    public function createAccount()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $userExist = User::getByUsername($username);
        if ($userExist) {
            $this->flushMessage('نام کاربری وارد شده از قبل موجود میباشد.', 'warning');
            $this->login();
        }
        else {
            $user = UserFactory::create($username, 'user', $password);
            $user->save();
            $this->flushMessage('حساب کاربری جدید ایجاد شد.', 'success');
            $login = User::login($username, $password);
            if ($login)
                $this->dashboard();
        }
    }

    public function loginAccount()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $login = User::login($username, $password);
        if ($login)
            $this->dashboard();
        else {
            $this->flushMessage('نام کاربری یا رمز عبور اشتباه است.', 'danger');
            $this->login();
        }
    }

    public function dashboard()
    {
        $compact = ['likes'];
        $likes = User::getLikes($_SESSION['user_id']);
        if (Helper::highThanAdmin()) {
            $posts = User::getPosts($_SESSION['user_id']);
            $compact[] = 'posts';
        }
        if (Helper::isSuperAdmin()) {
            $users = User::getAll();
            $compact[] = 'users';
        }
        $this->render('dashboard', compact($compact));
    }

    public function delUser()
    {
        $username = $_GET['user_username'];
        User::delUser($username);
        $this->flushMessage('کاربر مورد نظر حذف شد.', 'success');
        $this->dashboard();
    }
}
