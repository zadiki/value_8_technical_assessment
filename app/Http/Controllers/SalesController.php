<?php

namespace App\Http\Controllers;

use App\Interfaces\SaleServiceInterface;

class SalesController extends Controller
{
    private $salesService;

    public function __construct(SaleServiceInterface $salesService)
    {
        $this->salesService = $salesService;
    }
}
