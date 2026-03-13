<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;


class ProductController extends Controller
{
    public function getActiveProducts(Request $request)
    {
        $products = Product::where('is_active', true)->paginate(20);
        return response()->json($products);
    }
}
