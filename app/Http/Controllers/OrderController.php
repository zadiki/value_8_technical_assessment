<?php

namespace App\Http\Controllers;

use App\Interfaces\OrderServiceInterface;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }
    //
}
