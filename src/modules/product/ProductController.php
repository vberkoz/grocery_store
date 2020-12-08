<?php

include_once 'Product.php';
include_once 'ProductRenderer.php';
include_once ROOT.'/modules/category/Category.php';
include_once ROOT.'/modules/category/CategoryRenderer.php';

class ProductController
{
    public function index(): bool
    {
        echo json_encode(Product::selectAll());
        return true;
    }

    public function show(): bool
    {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);
        $product = Product::selectOne($decoded);
        $r = [
            'product' => $product,
            'categories' => Category::selectAll()
        ];
        echo json_encode($r);
        return true;
    }

    public function update(): bool
    {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);
        Product::update($decoded);
        ProductRenderer::details($decoded['id']);
        CategoryRenderer::details($decoded['category_id']);
        return true;
    }

    public function store(): bool
    {
        $product = Product::insert();
        echo json_encode($product);
        ProductRenderer::details($product['id']);
        return true;
    }

    public function destroy(): bool
    {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);
        Product::deleteSelected(implode(', ', $decoded));
        return true;
    }
}
