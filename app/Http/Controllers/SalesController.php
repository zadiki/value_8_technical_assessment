<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    private $salesService;
    public function __construct(SalesServiceInterface $salesService)
    {
        $this->salesService = $salesService;
    }
}
