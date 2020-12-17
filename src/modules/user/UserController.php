<?php

include_once 'UserService.php';

class UserController
{
    public function orders()
    {
        echo json_encode(UserService::orders($_POST['data']));
        return true;
    }

    public function logout()
    {
        UserService::logout();
        return true;
    }

    public function login()
    {
        echo json_encode(UserService::login($_POST['data']));
        return true;
    }

    public function logged()
    {
        echo json_encode(UserService::logged());
        return true;
    }
}
