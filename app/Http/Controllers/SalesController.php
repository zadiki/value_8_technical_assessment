<?php

namespace App\Http\Controllers;

class SalesController extends Controller
{
    private $salesService;

    public function __construct(SalesServiceInterface $salesService)
    {
        $this->salesService = $salesService;
    }
}
