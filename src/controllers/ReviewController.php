<?php

class ReviewController extends PublicBase
{
    public function actionSave(): bool
    {
        echo json_encode(Review::store($_POST['review']));
        return true;
    }
}
