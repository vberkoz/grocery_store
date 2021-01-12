<?php


class CategoryService
{
    public static function index($lang)
    {
        return Utils::storage([
            'columns' => 'id, title, slug',
            'table' => '001_category_'.$lang.'_details',
        ]);
    }
}
