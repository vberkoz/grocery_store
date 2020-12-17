<?php


class UtilsController
{
    public function copyImages()
    {
        echo json_encode(Utils::copyImages());
        return true;
    }

    public function slug()
    {
        echo json_encode(Utils::slug());
        return true;
    }
}
