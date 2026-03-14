<?php

namespace App\Http\Controllers;

use App\Services\ProductServiceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function getActiveProducts(Request $request)
    {
        $products = $this->productService->getProductByActiveStatus(true);

        return response()->json($products);
    }
}
