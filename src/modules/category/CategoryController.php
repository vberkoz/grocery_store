<?php

include_once 'Category.php';

class CategoryController
{
    public function index(): bool
    {
        echo json_encode(Category::selectAll());
        return true;
    }

    public function update(): bool
    {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);
        Category::updateAll($decoded);
        return true;
    }

    public function store(): bool
    {
        echo json_encode(Category::insert());
        return true;
    }

    public function destroy(): bool
    {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);
        Category::deleteSelected(implode(', ', $decoded));
        return true;
    }
}