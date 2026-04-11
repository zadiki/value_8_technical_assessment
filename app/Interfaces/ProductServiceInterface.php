<?php

declare(strict_types=1);

namespace App\Interfaces;

interface ProductServiceInterface
{
    public function createProduct($productData);

    public function getProductDetails($productId);

    public function updateProduct($productId, $productData);

    public function deleteProduct($productId);

    public function getProductByActiveStatus($isActive);
}
