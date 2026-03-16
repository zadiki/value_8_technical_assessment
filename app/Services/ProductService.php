<?php

namespace App\Services;

use App\Interfaces\ProductServiceInterface;
use App\Models\Product;

class ProductService implements ProductServiceInterface
{
    public function createProduct($productData)
    {
        // Implementation for creating a product
        $product = Product::create($productData);

        return $product;
    }

    public function getProductDetails($productId)
    {
        // Implementation for getting product details
        $product = Product::find($productId);

        return $product;
    }

    public function updateProduct($productId, $productData)
    {
        // Implementation for updating a product
        $product = Product::find($productId);
        $product->update($productData);

        return $product;
    }

    public function getAllProducts()
    {
        // Implementation for getting all products
        return Product::simplePaginate(100);
    }

    public function deleteProduct($productId)
    {
        // Implementation for deleting a product
        $product = Product::find($productId);
        $product->delete();

        return $product;
    }

    public function getProductByActiveStatus($isActive)
    {
        // Implementation for getting products by active status

        return Product::where('is_active', $isActive)->latest()->simplePaginate(100);
    }
}
