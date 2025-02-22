<?php

namespace App;

class Controller
{
    public function __construct()
    {
        session_start();
    }

    protected function render($view, $data = [])
    {
        extract($data);

        include "Views/$view.php";
    }

    protected function flushMessage($message, $type)
    {
        $_SESSION['message'] = $message;
        $_SESSION['alert-class'] = "alert-$type";
    }
}
