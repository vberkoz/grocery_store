<?php

class PostController
{
    /**
     * Show posts list
     * @return bool
     */
    public function actionIndex()
    {
        $categories = Category::getCategories();
        $posts = Post::index();
        require_once ROOT . '/views/post/index.php';
        return true;
    }

    /**
     * Displays single article
     * @param $id
     * @return bool
     */
    public function actionSingle($id) {
        $categories = Category::getCategories();
        $post = Post::single($id);
        require_once ROOT . '/views/post/single.php';
        return true;
    }
}