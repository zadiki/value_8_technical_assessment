<?php

namespace App\Services;

interface ProductServiceInterface
{
    public function createProduct($productData);
    public function getProductDetails($productId);
    public function updateProduct($productId, $productData);
    public function deleteProduct($productId);
    public function getProductByActiveStatus($isActive);
}
