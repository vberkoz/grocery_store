<?php

class LikeController
{
    public function actionProducts() {
        if (!User::isGuest()) {
            $userId = User::checkLogged();
            echo json_encode(Like::userLikesIds($userId));
        } else {
            echo 0;
        }
        return true;
    }

    public function actionAdd() {
        if (!User::isGuest()) {
            $userId = User::checkLogged();
            Like::add($userId, $_POST['id']);
            echo 1;
        } else {
            echo 0;
        }
        return true;
    }

    public function actionRemove() {
        Like::delete($_POST['id']);
        return true;
    }
}