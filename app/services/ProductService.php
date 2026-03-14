<?php

namespace App\Services;

use App\Models\Product;
use App\Interfaces\ProductServiceInterface;

class ProductService implements ProductServiceInterface
{
    public function createProduct($productData)
    {
        // Implementation for creating a product
    }

    public function getProductDetails($productId)
    {
        // Implementation for getting product details
    }

    public function updateProduct($productId, $productData)
    {
        // Implementation for updating a product
    }
   
    
    public function deleteProduct($productId)
    {
        // Implementation for deleting a product
    }

    public function getProductByActiveStatus($isActive)
    {
        // Implementation for getting products by active status

        return Product::where('is_active', $isActive)->get();
    }
}
