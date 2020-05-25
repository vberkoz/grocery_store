<?php

class AdminUserController extends AdminBase
{
    /**
     * Show users
     * @return bool
     */
    public function actionIndex()
    {
        self::checkAdmin();
        $users = User::getUsers();
        require_once ROOT . '/views/admin_user/index.php';
        return true;
    }
}